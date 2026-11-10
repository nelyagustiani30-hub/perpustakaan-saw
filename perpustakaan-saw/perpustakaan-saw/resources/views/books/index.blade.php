@extends('layouts.app')
@section('title', 'Data Buku')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data Buku</h3>
    <a href="{{ route('books.create') }}" class="btn btn-primary">+ Tambah Buku</a>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Kode</th><th>Judul</th><th>Penulis</th><th>Kategori</th>
                    <th>Dipinjam</th><th>Rating</th><th>Tahun</th><th>Stok</th><th>Rusak</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($books as $b)
                <tr>
                    <td>{{ $b->kode }}</td>
                    <td>{{ $b->judul }}</td>
                    <td>{{ $b->penulis }}</td>
                    <td>{{ $b->kategori }}</td>
                    <td>{{ $b->jumlah_dipinjam }}</td>
                    <td>{{ $b->rating }}</td>
                    <td>{{ $b->tahun_terbit }}</td>
                    <td>{{ $b->stok }}</td>
                    <td>{{ $b->kondisi_rusak }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('books.edit', $b) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('books.destroy', $b) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus buku ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="10" class="text-center py-4">Belum ada data buku.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $books->links() }}</div>
@endsection