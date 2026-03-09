# Author

Dyata Lintar Akbar  
NIM: 202310370311412  
Mata Kuliah: Rekayasa Kebutuhan B

---
# Sistem Pelacakan Alumni

Sistem Pelacakan Alumni adalah aplikasi web berbasis **Laravel** yang dirancang untuk membantu perguruan tinggi dalam melacak keberadaan alumni melalui berbagai sumber publik seperti **LinkedIn, Google Scholar, dan ResearchGate**.

Sistem ini mendukung kegiatan **tracer study**, pembaruan data alumni, serta meminimalkan kesalahan identifikasi melalui mekanisme **scoring kandidat dan verifikasi hasil pelacakan**.

---

# Fitur Sistem

### Manajemen Data Alumni
- Tambah data alumni
- Edit data alumni
- Hapus data alumni
- Melihat daftar alumni

### Profil Pencarian Alumni
- Sistem membentuk profil pencarian otomatis
- Menggunakan variasi nama dan konteks alumni

### Pelacakan Multi-Sumber
Sistem melakukan pencarian kandidat alumni dari beberapa sumber seperti:

- LinkedIn
- Google Scholar
- ResearchGate

### Penilaian Kandidat
Setiap kandidat hasil pencarian diberikan:

- **Skor kecocokan**
- **Status identifikasi**

Kategori skor:

| Skor | Status |
|-----|------|
| ≥ 80 | Kemungkinan Kuat |
| 60 – 79 | Perlu Verifikasi |
| < 60 | Tidak Cocok |

### Verifikasi Hasil
Admin dapat:

- membuka profil sumber kandidat
- memverifikasi kandidat alumni
- menyimpan hasil pelacakan

---

# Alur Sistem Pelacakan

1. Admin memasukkan data alumni
2. Sistem membentuk profil pencarian alumni
3. Sistem menghasilkan query pencarian
4. Sistem mencari kandidat dari berbagai sumber
5. Sistem menghitung skor kecocokan kandidat
6. Admin melakukan verifikasi kandidat
7. Status alumni diperbarui

---

# Teknologi yang Digunakan

| Teknologi | Keterangan |
|------|------|
| Laravel | Framework backend |
| PHP | Bahasa pemrograman |
| MySQL | Database |
| Blade | Template engine Laravel |
| Bootstrap | Tampilan UI |

---

# Cara Menjalankan Project

### 1 Clone repository
git clone https://github.com/Dytlnr/pelacakan-alumni.git

### 2 Masuk ke folder project
cd pelacakan-alumni

### 3 Install dependency
composer install

### 4 Copy file environment
cp .env.example .env

### 5 Generate key
php artisan key:generate

### 6 Jalankan migration database
php artisan migrate

### 7 Jalankan server
php artisan serve

Buka aplikasi di browser:
http://127.0.0.1:8000


---

# Tampilan Aplikasi

### Halaman Data Alumni
<img width="3584" height="2240" alt="image" src="https://github.com/user-attachments/assets/7caf88f2-e380-42d9-b63b-92a09dc971a0" />

### Halaman Detail Data Alumni
<img width="3584" height="2240" alt="image" src="https://github.com/user-attachments/assets/8ddfce05-2b78-4c9a-8c8f-3e0100b3dbce" />

### Halaman Menambahkan Alumni
<img width="3584" height="2240" alt="image" src="https://github.com/user-attachments/assets/b2f6200d-26e5-4abb-92d2-00abf956cf01" />

### Halaman Hasil Pelacakan
<img width="3584" height="2240" alt="image" src="https://github.com/user-attachments/assets/5b55b815-bede-468f-b450-f64b9541219c" />

---

# Hasil Pengujian Aplikasi

Pengujian dilakukan berdasarkan beberapa aspek kualitas sistem seperti **Functional Suitability, Reliability, Usability, Performance Efficiency, Security, dan Compatibility**.

| ID | Aspek Kualitas | Skenario Uji | Langkah Uji | Hasil Diharapkan | Hasil Aktual | Status |
|---|---|---|---|---|---|---|
| QF-01 | Functional Suitability | Tambah data alumni | Isi form tambah alumni lalu simpan | Data tersimpan di database | Data muncul di tabel alumni | Lulus |
| QF-02 | Functional Suitability | Edit data alumni | Edit data alumni lalu simpan | Data berubah sesuai input | Perubahan berhasil disimpan | Lulus |
| QF-03 | Functional Suitability | Hapus data alumni | Klik hapus pada daftar alumni | Data hilang dari daftar | Data berhasil dihapus | Lulus |
| QF-04 | Functional Suitability | Generate profil pencarian | Jalankan proses pelacakan | Profil pencarian dibuat otomatis | Proses berjalan tanpa error | Lulus |
| QF-05 | Functional Suitability | Proses pelacakan kandidat | Klik proses pelacakan | Kandidat hasil pelacakan muncul | Kandidat tampil dari berbagai sumber | Lulus |
| QF-06 | Functional Suitability | Lihat profil sumber | Klik tombol lihat sumber | Tautan sumber terbuka | Halaman sumber terbuka | Lulus |
| QF-07 | Functional Suitability | Verifikasi alumni | Klik verifikasi kandidat | Status alumni diperbarui | Status berubah menjadi teridentifikasi | Lulus |
| QF-08 | Functional Suitability | Simpan hasil | Klik simpan hasil | Status alumni tersimpan | Status berhasil diperbarui | Lulus |
| QR-01 | Reliability | Pelacakan tanpa hasil | Akses pelacakan tanpa kandidat | Sistem menampilkan pesan kosong | Pesan empty state muncul | Lulus |
| QR-02 | Reliability | Koneksi database | Akses halaman alumni | Data dapat dimuat | Halaman tampil normal | Lulus |
| QU-01 | Usability | Navigasi halaman | Navigasi antar menu | Navigasi mudah dipahami | Navigasi berjalan baik | Lulus |
| QU-02 | Usability | Kejelasan status | Lihat badge status | Status mudah dibaca | Status jelas terlihat | Lulus |
| QP-01 | Performance | Waktu muat halaman | Buka halaman alumni | Halaman cepat dimuat | Respons cepat | Lulus |
| QS-01 | Security | Validasi input | Kirim form kosong | Sistem menolak input | Validasi berhasil | Lulus |
| QC-01 | Compatibility | Responsif | Buka di desktop dan mobile | Layout tetap rapi | Tampilan responsif | Lulus |

---

