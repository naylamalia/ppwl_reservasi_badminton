<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Court;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ReservationController extends Controller
{
    /**
     * Middleware untuk mengatur izin akses.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menampilkan daftar reservasi.
     */
    public function index(): View
    {
        $reservations = Reservation::latest()->paginate(5); // Mengambil semua reservasi
        return view('reservations.index', compact('reservations'));
    }

    /**
     * Menampilkan form untuk membuat reservasi baru.
     */
    public function create(): View
    {
        $courts = Court::all(); // Mengambil semua data lapangan
        return view('reservations.create', compact('courts'));
    }

    /**
     * Menyimpan reservasi baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'courts_id' => 'required|exists:courts,id',
            'nama' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'total_harga' => 'required|integer|min:0',
        ]);

        Reservation::create($request->all());

        return redirect()->route('reservations.index')->with('success', 'Reservasi berhasil dibuat.');
    }

    /**
     * Menampilkan detail reservasi.
     */
    public function show($id): View
    {
        $reservation = Reservation::with('court')->findOrFail($id); // Mengambil detail reservasi dengan relasi lapangan
        return view('reservations.show', compact('reservation'));
    }

    /**
     * Menampilkan form untuk mengedit reservasi.
     */
    public function edit(Reservation $reservation): View
    {
        $courts = Court::all(); // Mengambil semua data lapangan
        return view('reservations.edit', compact('reservation', 'courts'));
    }

    /**
     * Memperbarui data reservasi di database.
     */
    public function update(Request $request, Reservation $reservation): RedirectResponse
    {
        $request->validate([
            'courts_id' => 'required|exists:courts,id',
            'nama' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'total_harga' => 'required|integer|min:0',
        ]);

        $reservation->update($request->all());

        return redirect()->route('reservations.index')->with('success', 'Reservasi berhasil diperbarui.');
    }

    /**
     * Menghapus reservasi.
     */
    public function destroy(Reservation $reservation): RedirectResponse
    {
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Reservasi berhasil dihapus.');
    }
}