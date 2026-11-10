@extends('layouts.app')
@section('title', $book->exists ? 'Edit Buku' : 'Tambah Buku')

@section('content')
<h3 class="mb-3">{{ $book->exists ? 'Edit Buku' : 'Tambah Buku' }}</h3>

<form method="POST"
      action="{{ $book->exists ? route('books.update', $book) : route('books.store') }}"
      class="card card-body shadow-sm">
    @csrf
    @if ($book->exists) @method('PUT') @endif

    <div class="row g-3">
        @php
            $fields = [
                ['kode', 'Kode Buku', 'text', 4],
                ['judul', 'Judul', 'text', 8],
                ['penulis', 'Penulis', 'text', 6],
                ['kategori', 'Kategori', 'text', 6],
                ['jumlah_dipinjam', 'Jumlah Dipinjam (C1)', 'number', 4],
                ['rating', 'Rating 0-5 (C2)', 'number', 4],
                ['tahun_terbit', 'Tahun Terbit (C3)', 'number', 4],
                ['stok', 'Stok Tersedia (C4)', 'number', 6],
                ['kondisi_rusak', 'Tingkat Kerusakan 1-5 (C5, cost)', 'number', 6],
            ];
        @endphp

        @foreach ($fields as [$name, $label, $type, $col])
            <div class="col-md-{{ $col }}">
                <label class="form-label">{{ $label }}</label>
                <input type="{{ $type }}" step="any" name="{{ $name }}"
                       value="{{ old($name, $book->$name) }}" class="form-control" required>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>
@endsection
