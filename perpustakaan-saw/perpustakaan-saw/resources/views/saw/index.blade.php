@extends('layouts.app')
@section('title', 'Rekomendasi SAW')

@section('content')
<h3 class="mb-3">Rekomendasi Buku (Metode SAW)</h3>

@if (empty($hasil))
    <div class="alert alert-info">Data buku atau kriteria belum tersedia.</div>
@else
    {{-- Kriteria --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header fw-bold">1. Kriteria &amp; Bobot</div>
        <table class="table mb-0">
            <thead><tr><th>Kode</th><th>Kriteria</th><th>Tipe</th><th>Bobot</th></tr></thead>
            <tbody>
            @foreach ($criteria as $c)
                <tr>
                    <td>{{ $c->kode }}</td><td>{{ $c->nama }}</td>
                    <td><span class="badge bg-{{ $c->tipe == 'benefit' ? 'success' : 'danger' }}">{{ $c->tipe }}</span></td>
                    <td>{{ $c->bobot }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{-- Matriks keputusan --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header fw-bold">2. Matriks Keputusan (X)</div>
        <div class="table-responsive">
            <table class="table table-sm mb-0">
                <thead><tr><th>Buku</th>@foreach ($criteria as $c)<th>{{ $c->kode }}</th>@endforeach</tr></thead>
                <tbody>
                @foreach ($books as $b)
                    <tr>
                        <td>{{ $b->judul }}</td>
                        @foreach ($criteria as $c)<td>{{ $matriks[$b->id][$c->kode] }}</td>@endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Normalisasi --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header fw-bold">3. Matriks Normalisasi (R)</div>
        <div class="table-responsive">
            <table class="table table-sm mb-0">
                <thead><tr><th>Buku</th>@foreach ($criteria as $c)<th>{{ $c->kode }}</th>@endforeach</tr></thead>
                <tbody>
                @foreach ($books as $b)
                    <tr>
                        <td>{{ $b->judul }}</td>
                        @foreach ($criteria as $c)<td>{{ $normalisasi[$b->id][$c->kode] }}</td>@endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Ranking --}}
    <div class="card shadow-sm">
        <div class="card-header fw-bold bg-primary text-white">4. Hasil Perankingan (V)</div>
        <table class="table table-striped mb-0">
            <thead><tr><th>Rank</th><th>Kode</th><th>Judul</th><th>Penulis</th><th>Nilai Preferensi</th></tr></thead>
            <tbody>
            @foreach ($hasil as $row)
                <tr class="{{ $row['rank'] == 1 ? 'table-success fw-bold' : '' }}">
                    <td>{{ $row['rank'] }}</td>
                    <td>{{ $row['book']->kode }}</td>
                    <td>{{ $row['book']->judul }}</td>
                    <td>{{ $row['book']->penulis }}</td>
                    <td>{{ $row['nilai'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection