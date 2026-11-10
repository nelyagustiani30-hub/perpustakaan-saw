# Sistem Informasi Perpustakaan Berbasis Web Menggunakan Laravel — Metode Simple Additive Weighting (SAW)

Project tugas: aplikasi perpustakaan berbasis **Laravel 12** dengan UI **Bootstrap 5**. Halaman CRUD utamanya adalah **Kelola Data Buku**, terhubung ke **Model `Book`** dengan struktur tabel dari **migration**. Selain itu ada fitur rekomendasi buku memakai metode **SAW (Simple Additive Weighting)**.

## Sesuai Ketentuan Tugas

| No | Ketentuan | Implementasi |
|----|-----------|--------------|
| 1 | Project Laravel 12 ke atas | Laravel 12 (`laravel/framework ^12.0`) |
| 2 | UI dengan Tailwind / Bootstrap / CSS manual | Bootstrap 5 (CDN) di `resources/views/layouts/app.blade.php` |
| 3 | Satu halaman CRUD | Kelola Data Buku: `/books` (tambah, lihat, ubah, hapus) |
| 4 | Terhubung ke Model + migration | `app/Models/Book.php` dan `database/migrations/*_create_books_table.php` |
| 5 | Upload ke GitHub | Lihat bagian "Upload ke GitHub" di bawah |

## Fitur
- CRUD data buku (halaman utama)
- Pengelolaan kriteria dan bobot SAW
- Perhitungan SAW otomatis: matriks keputusan, normalisasi, nilai preferensi, dan ranking
- Tabel anggota dan peminjaman sudah disiapkan untuk pengembangan lanjut

## Kriteria SAW

| Kode | Kriteria | Tipe | Bobot |
|------|----------|------|-------|
| C1 | Jumlah Dipinjam | Benefit | 0.30 |
| C2 | Rating | Benefit | 0.25 |
| C3 | Tahun Terbit | Benefit | 0.20 |
| C4 | Stok Tersedia | Benefit | 0.15 |
| C5 | Tingkat Kerusakan | Cost | 0.10 |

Rumus:
- Benefit: `r_ij = x_ij / max(x_j)`
- Cost: `r_ij = min(x_j) / x_ij`
- Nilai preferensi: `V_i = Σ (w_j × r_ij)`, buku dengan `V` terbesar adalah rekomendasi terbaik.

## Cara Menjalankan

Kebutuhan: PHP 8.2+ dan Composer.

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite      # Windows: type nul > database\database.sqlite
php artisan migrate --seed
php artisan serve
```

Buka `http://127.0.0.1:8000`. Secara bawaan Laravel 12 memakai SQLite; kalau mau MySQL, ubah `DB_*` di `.env` lalu jalankan `php artisan migrate --seed`.

## Upload ke GitHub

1. Buat repository kosong di GitHub (misalnya `perpustakaan-saw`), tanpa README.
2. Di folder project:
   ```bash
   git init
   git add .
   git commit -m "Sistem Informasi Perpustakaan Laravel + SAW"
   git branch -M main
   git remote add origin https://github.com/USERNAME/perpustakaan-saw.git
   git push -u origin main
   ```
   Folder `vendor/` dan file `.env` otomatis tidak ikut ter-upload karena sudah ada di `.gitignore`.

## Struktur Utama

```
app/
  Http/Controllers/  BookController.php (CRUD), SawController.php
  Models/            Book, Criterion, Member, Loan
  Services/          SawService.php   <- logika perhitungan SAW
database/
  migrations/        books, criteria, members, loans
  seeders/           DatabaseSeeder.php (kriteria + data contoh)
resources/views/
  layouts/app.blade.php
  books/             index, form
  saw/               index, kriteria
routes/web.php
```
