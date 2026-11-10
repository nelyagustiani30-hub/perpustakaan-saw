<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Criterion;

/**
 * Metode Simple Additive Weighting (SAW)
 *
 * 1. Tentukan kriteria (benefit / cost) dan bobot (W).
 * 2. Susun matriks keputusan X (alternatif x kriteria).
 * 3. Normalisasi:
 *      benefit : r_ij = x_ij / max(x_j)
 *      cost    : r_ij = min(x_j) / x_ij
 * 4. Nilai preferensi: V_i = sum(w_j * r_ij)
 * 5. Urutkan V_i dari terbesar -> ranking rekomendasi.
 */
class SawService
{
    public function hitung(): array
    {
        $criteria = Criterion::orderBy('kode')->get();
        $books    = Book::all();

        if ($criteria->isEmpty() || $books->isEmpty()) {
            return ['criteria' => $criteria, 'matriks' => [], 'normalisasi' => [], 'hasil' => []];
        }

        // 1. Matriks keputusan X
        $matriks = [];
        foreach ($books as $book) {
            foreach ($criteria as $c) {
                $matriks[$book->id][$c->kode] = (float) $book->{$c->field};
            }
        }

        // Nilai max / min tiap kriteria
        $max = $min = [];
        foreach ($criteria as $c) {
            $kolom         = array_column($matriks, $c->kode);
            $max[$c->kode] = max($kolom);
            $min[$c->kode] = min($kolom);
        }

        // 2. Normalisasi R
        $normalisasi = [];
        foreach ($books as $book) {
            foreach ($criteria as $c) {
                $x = $matriks[$book->id][$c->kode];

                if ($c->tipe === 'benefit') {
                    $r = $max[$c->kode] > 0 ? $x / $max[$c->kode] : 0;
                } else {
                    $r = $x > 0 ? $min[$c->kode] / $x : 0;
                }

                $normalisasi[$book->id][$c->kode] = round($r, 4);
            }
        }

        // 3. Nilai preferensi V
        $hasil = [];
        foreach ($books as $book) {
            $v = 0;
            foreach ($criteria as $c) {
                $v += $c->bobot * $normalisasi[$book->id][$c->kode];
            }
            $hasil[] = [
                'book'  => $book,
                'nilai' => round($v, 4),
            ];
        }

        // 4. Ranking
        usort($hasil, fn ($a, $b) => $b['nilai'] <=> $a['nilai']);
        foreach ($hasil as $i => &$row) {
            $row['rank'] = $i + 1;
        }
        unset($row);

        return [
            'criteria'    => $criteria,
            'matriks'     => $matriks,
            'normalisasi' => $normalisasi,
            'hasil'       => $hasil,
            'books'       => $books,
        ];
    }
}