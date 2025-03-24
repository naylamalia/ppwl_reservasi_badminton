<?php

namespace App\Http\Controllers;

use App\Models\Court;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CourtController extends Controller
{
    /**
     * Middleware untuk mengatur izin akses.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menampilkan daftar lapangan.
     */
    public function index(): View
    {
        $courts = Court::latest()->paginate(5);
        return view('courts.index', compact('courts'));
    }

    /**
     * Menampilkan form untuk membuat lapangan baru.
     */
    public function create(): View
    {
        return view('courts.create');
    }

    /**
     * Menyimpan lapangan baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga_per_jam' => 'required|numeric|min:0',
            'status' => 'required|in:tersedia,tidak tersedia',
            'jadwal_operasional' => 'nullable|json',
            'kapasitas' => 'required|integer|min:1',
        ]);

        Court::create($request->all());

        return redirect()->route('courts.index')
            ->with('success', 'Court created successfully.');
    }

    /**
     * Menampilkan detail lapangan.
     */
    public function show(Court $court): View
    {
        return view('courts.show', compact('court'));
    }

    /**
     * Menampilkan form untuk mengedit lapangan.
     */
    public function edit(Court $court): View
    {
        return view('courts.edit', compact('court'));
    }

    /**
     * Memperbarui data lapangan di database.
     */
    public function update(Request $request, Court $court): RedirectResponse
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga_per_jam' => 'required|numeric|min:0',
            'status' => 'required|in:tersedia,tidak tersedia',
            'jadwal_operasional' => 'nullable|json',
            'kapasitas' => 'required|integer|min:1',
        ]);

        $court->update($request->all());

        return redirect()->route('courts.index')
            ->with('success', 'Court updated successfully.');
    }

    /**
     * Menghapus lapangan.
     */
    public function destroy(Court $court): RedirectResponse
    {
        $court->delete();
        return redirect()->route('courts.index')
            ->with('success', 'Court deleted successfully.');
    }
}