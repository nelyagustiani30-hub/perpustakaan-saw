@extends('layouts.app')
@section('title', 'Kriteria & Bobot')

@section('content')
<h3 class="mb-3">Kriteria &amp; Bobot SAW</h3>

<form method="POST" action="{{ route('saw.kriteria.update') }}" class="card card-body shadow-sm">
    @csrf @method('PUT')

    <table class="table">
        <thead><tr><th>Kode</th><th>Kriteria</th><th>Tipe</th><th style="width:160px">Bobot</th></tr></thead>
        <tbody>
        @foreach ($criteria as $c)
            <tr>
                <td>{{ $c->kode }}</td>
                <td>{{ $c->nama }}</td>
                <td><span class="badge bg-{{ $c->tipe == 'benefit' ? 'success' : 'danger' }}">{{ $c->tipe }}</span></td>
                <td>
                    <input type="number" step="0.01" min="0" max="1"
                           name="bobot[{{ $c->id }}]" value="{{ old('bobot.' . $c->id, $c->bobot) }}"
                           class="form-control" required>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <p class="text-muted">Total bobot semua kriteria harus sama dengan 1.</p>
    <div>
        <button class="btn btn-primary">Simpan Bobot</button>
        <a href="{{ route('saw.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</form>
@endsection