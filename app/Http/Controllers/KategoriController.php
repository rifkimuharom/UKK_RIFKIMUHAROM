<?php

namespace App\Http\Controllers;

use App\Models\Category; // <--- Menggunakan model Category
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Category::all();
        return view('kategori.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Category::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'status' => true,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function destroy(Category $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}