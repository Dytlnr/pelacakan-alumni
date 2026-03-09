# Sistem Pelacakan Alumni

Aplikasi web untuk melacak keberadaan alumni berdasarkan pencarian dari berbagai sumber publik seperti LinkedIn, Google Scholar, dan ResearchGate. Sistem ini membantu perguruan tinggi dalam melakukan tracer study, memperbarui data alumni, serta mengurangi kesalahan identifikasi melalui mekanisme scoring dan verifikasi hasil pelacakan.

---

## Teknologi yang Digunakan

- Laravel
- PHP
- MySQL
- Blade Template
- Bootstrap

---

## Fitur Sistem

- Manajemen data alumni (tambah, edit, hapus)
- Pembuatan profil pencarian alumni
- Pelacakan kandidat alumni dari berbagai sumber publik
- Perhitungan skor kecocokan kandidat
- Penentuan status kecocokan alumni
- Dashboard hasil pelacakan
- Verifikasi kandidat hasil pelacakan
- Penyimpanan hasil pelacakan sebagai jejak bukti

---

## Cara Menjalankan Project

1. Clone repository


git clone https://github.com/Dytlnr/pelacakan-alumni.git


2. Masuk ke folder project


cd pelacakan-alumni


3. Install dependency


composer install


4. Copy file environment


cp .env.example .env


5. Generate key Laravel


php artisan key:generate


6. Jalankan migration database


php artisan migrate


7. Jalankan server


php artisan serve


Buka aplikasi di browser:


http://127.0.0.1:8000


---

# Hasil Pengujian Aplikasi

Pengujian aplikasi dilakukan berdasarkan aspek kualitas sistem seperti Functional Suitability, Reliability, Usability, Performance Efficiency, Security, dan Compatibility.

| ID | Aspek Kualitas | Skenario Uji | Langkah Uji Singkat | Hasil Diharapkan | Hasil Aktual | Status |
|---|---|---|---|---|---|---|
| QF-01 | Functional Suitability | Tambah data alumni | Buka `Tambah Alumni` → isi field wajib (`nama`, `prodi`, `tahun_lulus`) → simpan | Data alumni baru tersimpan dan tampil di tabel alumni | Data berhasil masuk dan muncul pada daftar alumni | Lulus |
| QF-02 | Functional Suitability | Edit data alumni | Buka detail alumni → klik `Edit` → ubah data → simpan | Perubahan data tersimpan dan tampil pada detail/list | Data berubah sesuai input | Lulus |
| QF-03 | Functional Suitability | Hapus data alumni | Pada list alumni klik ikon hapus → konfirmasi | Data terhapus dari daftar | Data hilang dari tabel alumni | Lulus |
| QF-04 | Functional Suitability | Generate profil pencarian otomatis | Masuk halaman pelacakan alumni yang belum punya profil → klik `Proses Pelacakan Ulang` | Sistem membuat profil pencarian otomatis lalu lanjut pelacakan | Tidak ada error “profil belum dibuat”, proses berjalan | Lulus |
| QF-05 | Functional Suitability | Proses pelacakan kandidat | Pada halaman pelacakan klik `Proses Pelacakan Ulang` | Kandidat hasil pelacakan muncul dengan skor dan status | Kandidat tampil dari beberapa sumber | Lulus |
| QF-06 | Functional Suitability | Tombol `Lihat Profil Sumber` | Klik tombol `Lihat {Sumber}` pada baris hasil | Membuka tautan sumber yang sesuai | Tautan sumber terbuka sesuai platform | Lulus |
| QF-07 | Functional Suitability | Tombol `Verifikasi Alumni` | Klik `Verifikasi Alumni` pada kandidat | Status kandidat menjadi terverifikasi | Status berubah dan notifikasi sukses tampil | Lulus |
| QF-08 | Functional Suitability | Tombol `Simpan Hasil` | Klik `Simpan Hasil` pada kandidat | Status alumni diperbarui sesuai skor kandidat | Status alumni ter-update | Lulus |
| QR-01 | Reliability | Penanganan data kosong pada pelacakan | Akses pelacakan alumni tanpa hasil | Sistem menampilkan pesan empty state tanpa error | Pesan “Tidak ada kandidat…” tampil | Lulus |
| QR-02 | Reliability | Koneksi database saat aplikasi berjalan | Akses halaman list/detail saat DB aktif | Halaman dapat memuat data tanpa error | Berjalan normal pada konfigurasi DB aktif | Lulus |
| QU-01 | Usability | Navigasi antar halaman | Uji alur List → Detail → Edit → Pelacakan → Kembali | Navigasi konsisten dan mudah dipahami | Navigasi berjalan baik | Lulus |
| QU-02 | Usability | Kejelasan informasi status | Lihat badge status di list dan detail | Status mudah dibaca oleh pengguna | Badge dan label status jelas | Lulus |
| QP-01 | Performance Efficiency | Waktu muat halaman utama alumni | Buka `/alumni` dengan data uji kecil-menengah | Halaman tampil cepat tanpa delay signifikan | Respons cepat pada pengujian lokal | Lulus |
| QS-01 | Security | Validasi input form alumni | Kirim form dengan field wajib kosong | Sistem menolak input dan menampilkan pesan validasi | Validasi berjalan, data tidak tersimpan | Lulus |
| QC-01 | Compatibility | Tampilan responsif | Uji di desktop dan tampilan mobile | Layout tetap rapi dan dapat digunakan | Tampilan responsif sesuai CSS | Lulus |

---

## Author

Dyata Lintar Akbar  
NIM: 202310370311412  
Mata Kuliah: Rekayasa Kebutuhan B
