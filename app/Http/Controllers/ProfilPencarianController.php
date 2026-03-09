<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\ProfilPencarian;

class ProfilPencarianController extends Controller
{
    public function show(Alumni $alumni)
    {
        $profil = $alumni->profilPencarian;
        return view('profil_pencarian.show', compact('alumni', 'profil'));
    }

    public function generate(Alumni $alumni)
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

        ProfilPencarian::updateOrCreate(
            ['alumni_id' => $alumni->id],
            [
                'variasi_nama' => array_values(array_unique($variasiNama)),
                'keyword_afiliasi' => $keywordAfiliasi,
                'keyword_konteks' => $keywordKonteks,
            ]
        );

        return redirect()->route('profil.show', $alumni->id)
            ->with('success', 'Profil pencarian berhasil dibuat.');
    }
}
