<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SI Perpustakaan') - SAW</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('books.index') }}">📚 SI Perpustakaan</a>
        <div class="navbar-nav">
            <a class="nav-link" href="{{ route('books.index') }}">Data Buku</a>
            <a class="nav-link" href="{{ route('saw.index') }}">Rekomendasi SAW</a>
            <a class="nav-link" href="{{ route('saw.kriteria') }}">Kriteria &amp; Bobot</a>
        </div>
    </div>
</nav>

<div class="container pb-5">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</div>
</body>
</html>