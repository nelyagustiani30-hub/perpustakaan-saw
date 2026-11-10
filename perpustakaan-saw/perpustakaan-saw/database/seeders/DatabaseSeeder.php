<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Criterion;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Kriteria SAW (total bobot = 1)
        $kriteria = [
            ['kode' => 'C1', 'nama' => 'Jumlah Dipinjam',   'field' => 'jumlah_dipinjam', 'tipe' => 'benefit', 'bobot' => 0.30],
            ['kode' => 'C2', 'nama' => 'Rating',            'field' => 'rating',          'tipe' => 'benefit', 'bobot' => 0.25],
            ['kode' => 'C3', 'nama' => 'Tahun Terbit',      'field' => 'tahun_terbit',    'tipe' => 'benefit', 'bobot' => 0.20],
            ['kode' => 'C4', 'nama' => 'Stok Tersedia',     'field' => 'stok',            'tipe' => 'benefit', 'bobot' => 0.15],
            ['kode' => 'C5', 'nama' => 'Tingkat Kerusakan', 'field' => 'kondisi_rusak',   'tipe' => 'cost',    'bobot' => 0.10],
        ];
        foreach ($kriteria as $k) {
            Criterion::create($k);
        }

        // Data buku contoh
        $buku = [
            ['B001', 'Pemrograman Web dengan Laravel', 'Budi Raharjo',  'Teknologi',         120, 4.8, 2023, 5,  1],
            ['B002', 'Basis Data Lanjut',              'Rosa A.S.',     'Teknologi',         95,  4.5, 2020, 8,  2],
            ['B003', 'Algoritma dan Struktur Data',    'Rinaldi Munir', 'Teknologi',         150, 4.6, 2018, 3,  3],
            ['B004', 'Sistem Pendukung Keputusan',     'Kusrini',       'Teknologi',         70,  4.3, 2021, 6,  2],
            ['B005', 'Manajemen Perpustakaan Digital', 'Sulistyo B.',   'Ilmu Perpustakaan', 40,  4.0, 2022, 10, 1],
            ['B006', 'Statistika Dasar',               'Sudjana',       'Matematika',        85,  4.2, 2015, 4,  4],
        ];
        foreach ($buku as [$kode, $judul, $penulis, $kat, $pinjam, $rating, $tahun, $stok, $rusak]) {
            Book::create([
                'kode' => $kode, 'judul' => $judul, 'penulis' => $penulis, 'kategori' => $kat,
                'jumlah_dipinjam' => $pinjam, 'rating' => $rating, 'tahun_terbit' => $tahun,
                'stok' => $stok, 'kondisi_rusak' => $rusak,
            ]);
        }
    }
}