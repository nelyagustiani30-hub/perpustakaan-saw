<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private function rules(?int $id = null): array
    {
        return [
            'kode'            => 'required|max:20|unique:books,kode' . ($id ? ",$id" : ''),
            'judul'           => 'required|max:255',
            'penulis'         => 'required|max:255',
            'kategori'        => 'nullable|max:100',
            'jumlah_dipinjam' => 'required|integer|min:0',
            'rating'          => 'required|numeric|min:0|max:5',
            'tahun_terbit'    => 'required|integer|min:1900|max:' . date('Y'),
            'stok'            => 'required|integer|min:0',
            'kondisi_rusak'   => 'required|integer|min:1|max:5',
        ];
    }

    public function index()
    {
        $books = Book::latest()->paginate(10);
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.form', ['book' => new Book()]);
    }

    public function store(Request $request)
    {
        Book::create($request->validate($this->rules()));
        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Book $book)
    {
        return view('books.form', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $book->update($request->validate($this->rules($book->id)));
        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    }
}