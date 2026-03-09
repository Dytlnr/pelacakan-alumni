<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\HasilPelacakan;
use App\Models\ProfilPencarian;
use Illuminate\Http\RedirectResponse;

class PelacakanController extends Controller
{
    public function index(Alumni $alumni)
    {
        $profil = $alumni->profilPencarian;
        $hasil = $alumni->hasilPelacakan()->latest()->get();

        return view('pelacakan.index', compact('alumni', 'profil', 'hasil'));
    }

    public function proses(Alumni $alumni)
    {
        $profil = $alumni->profilPencarian;
        $namaEncoded = urlencode($alumni->nama);
        $prodiEncoded = urlencode($alumni->prodi);
        $kotaEncoded = urlencode($alumni->kota ?: '');

        if (!$profil) {
            $profil = $this->buatProfilOtomatis($alumni);
        }

        $alumni->hasilPelacakan()->delete();

        $candidates = [
            [
                'sumber' => 'LinkedIn',
                'nama_kandidat' => $alumni->nama,
                'afiliasi' => 'PT Teknologi Malang',
                'jabatan' => 'Software Engineer',
                'lokasi' => $alumni->kota ?: 'Malang',
                'topik' => $alumni->bidang ?: 'Informatika',
                'link_bukti' => 'https://www.linkedin.com/search/results/people/?keywords=' . $namaEncoded . '%20' . $prodiEncoded . '%20' . $kotaEncoded,
                'ringkasan' => 'Profil profesional dengan nama dan lokasi yang relevan.',
            ],
            [
                'sumber' => 'Google Scholar',
                'nama_kandidat' => $alumni->nama,
                'afiliasi' => 'Universitas Muhammadiyah Malang',
                'jabatan' => 'Penulis Publikasi',
                'lokasi' => 'Malang',
                'topik' => $alumni->bidang ?: 'Informatika',
                'link_bukti' => 'https://scholar.google.com/scholar?q=' . $namaEncoded . '%20' . $prodiEncoded,
                'ringkasan' => 'Profil akademik dengan afiliasi kampus.',
            ],
            [
                'sumber' => 'ResearchGate',
                'nama_kandidat' => 'M. ' . explode(' ', $alumni->nama)[0],
                'afiliasi' => 'Universitas Lain',
                'jabatan' => 'Research Assistant',
                'lokasi' => 'Jakarta',
                'topik' => 'Data Science',
                'link_bukti' => 'https://www.researchgate.net/search/publication?q=' . $namaEncoded,
                'ringkasan' => 'Nama mirip tetapi afiliasi kurang sesuai.',
            ],
        ];

        foreach ($candidates as $candidate) {
            $skor = $this->hitungSkor($alumni, $candidate);
            $status = $this->tentukanStatus($skor);

            HasilPelacakan::create([
                'alumni_id' => $alumni->id,
                'sumber' => $candidate['sumber'],
                'nama_kandidat' => $candidate['nama_kandidat'],
                'afiliasi' => $candidate['afiliasi'],
                'jabatan' => $candidate['jabatan'],
                'lokasi' => $candidate['lokasi'],
                'topik' => $candidate['topik'],
                'skor' => $skor,
                'status' => $status,
                'link_bukti' => $candidate['link_bukti'],
                'ringkasan' => $candidate['ringkasan'],
            ]);
        }

        $best = $alumni->hasilPelacakan()->orderByDesc('skor')->first();

        if ($best) {
            if ($best->skor >= 80) {
                $alumni->update(['status' => 'Teridentifikasi']);
            } elseif ($best->skor >= 55) {
                $alumni->update(['status' => 'Perlu Verifikasi Manual']);
            } else {
                $alumni->update(['status' => 'Belum Ditemukan']);
            }
        }

        return redirect()->route('pelacakan.index', $alumni->id)
            ->with('success', 'Pelacakan alumni berhasil dijalankan.');
    }

    public function verifikasi(Alumni $alumni, HasilPelacakan $hasil): RedirectResponse
    {
        if ($hasil->alumni_id !== $alumni->id) {
            abort(404);
        }

        $hasil->update([
            'status' => 'Terverifikasi',
        ]);

        $alumni->update([
            'status' => 'Teridentifikasi',
        ]);

        return redirect()->route('pelacakan.index', $alumni->id)
            ->with('success', 'Hasil kandidat berhasil diverifikasi.');
    }

    public function simpan(Alumni $alumni, HasilPelacakan $hasil): RedirectResponse
    {
        if ($hasil->alumni_id !== $alumni->id) {
            abort(404);
        }

        $statusAlumni = 'Belum Ditemukan';
        if ($hasil->skor >= 80) {
            $statusAlumni = 'Teridentifikasi';
        } elseif ($hasil->skor >= 55) {
            $statusAlumni = 'Perlu Verifikasi Manual';
        }

        $alumni->update([
            'status' => $statusAlumni,
        ]);

        return redirect()->route('pelacakan.index', $alumni->id)
            ->with('success', 'Hasil pelacakan dipilih dan disimpan.');
    }

    private function hitungSkor($alumni, $candidate)
    {
        $score = 0;

        if (strcasecmp(trim($alumni->nama), trim($candidate['nama_kandidat'])) === 0) {
            $score += 40;
        } elseif (stripos($candidate['nama_kandidat'], explode(' ', $alumni->nama)[0]) !== false) {
            $score += 20;
        }

        $targetAfiliasi = ['Universitas Muhammadiyah Malang', 'UMM', $alumni->prodi];
        foreach ($targetAfiliasi as $item) {
            if ($item && stripos($candidate['afiliasi'], $item) !== false) {
                $score += 25;
                break;
            }
        }

        if ($alumni->kota && $candidate['lokasi'] && strcasecmp($alumni->kota, $candidate['lokasi']) === 0) {
            $score += 15;
        }

        if ($alumni->bidang && $candidate['topik'] && stripos($candidate['topik'], $alumni->bidang) !== false) {
            $score += 20;
        }

        return min($score, 100);
    }

    private function tentukanStatus($score)
    {
        if ($score >= 80) {
            return 'Kemungkinan Kuat';
        } elseif ($score >= 55) {
            return 'Perlu Verifikasi';
        }

        return 'Tidak Cocok';
    }

    private function buatProfilOtomatis(Alumni $alumni): ProfilPencarian
    {
        $nama = trim($alumni->nama);
        $parts = preg_split('/\s+/', $nama);

        $variasiNama = [$nama];

        if (count($parts) >= 2) {
            $first = $parts[0];
            $last = $parts[count($parts) - 1];

            $variasiNama[] = $first . ' ' . $last;
            $variasiNama[] = strtoupper(substr($first, 0, 1)) . '. ' . $last;
            $variasiNama[] = $first . ' ' . strtoupper(substr($last, 0, 1)) . '.';
        }

        $keywordAfiliasi = array_values(array_filter([
            'Universitas Muhammadiyah Malang',
            'UMM',
            $alumni->prodi,
        ]));

        $keywordKonteks = array_values(array_filter([
            $alumni->tahun_lulus,
            $alumni->kota,
            $alumni->bidang,
        ]));

        return ProfilPencarian::updateOrCreate(
            ['alumni_id' => $alumni->id],
            [
                'variasi_nama' => array_values(array_unique($variasiNama)),
                'keyword_afiliasi' => $keywordAfiliasi,
                'keyword_konteks' => $keywordKonteks,
            ]
        );
    }
}
