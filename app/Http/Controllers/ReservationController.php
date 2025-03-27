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
    ]);

    // Ambil data lapangan berdasarkan ID
    $court = Court::findOrFail($request->courts_id);

    // Hitung durasi dalam jam
    $jamMulai = strtotime($request->jam_mulai);
    $jamSelesai = strtotime($request->jam_selesai);
    $durasi = ($jamSelesai - $jamMulai) / 3600; // Konversi detik ke jam

    // Hitung total harga
    $totalHarga = $durasi * $court->harga_per_jam;

    // Simpan data reservasi
    Reservation::create([
        'courts_id' => $request->courts_id,
        'nama' => $request->nama,
        'tanggal' => $request->tanggal,
        'jam_mulai' => $request->jam_mulai,
        'jam_selesai' => $request->jam_selesai,
        'total_harga' => $totalHarga,
        'status' => 'pending', // Set status default ke pending
    ]);

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
    ]);

    // Ambil data lapangan berdasarkan ID
    $court = Court::findOrFail($request->courts_id);

    // Hitung durasi dalam jam
    $jamMulai = strtotime($request->jam_mulai);
    $jamSelesai = strtotime($request->jam_selesai);
    $durasi = ($jamSelesai - $jamMulai) / 3600; // Konversi detik ke jam

    // Hitung total harga
    $totalHarga = $durasi * $court->harga_per_jam;

    // Perbarui data reservasi
    $reservation->update([
        'courts_id' => $request->courts_id,
        'nama' => $request->nama,
        'tanggal' => $request->tanggal,
        'jam_mulai' => $request->jam_mulai,
        'jam_selesai' => $request->jam_selesai,
        'total_harga' => $totalHarga,
    ]);

    return redirect()->route('reservations.index')->with('success', 'Reservasi berhasil diperbarui.');
}
    
    public function approve(Reservation $reservation): RedirectResponse
    {
        if (Auth::user()->hasRole('Admin')) {
            $reservation->update(['status' => 'approved']);
            return redirect()->route('reservations.index')->with('success', 'Reservasi berhasil disetujui.');
        }
    
        return redirect()->route('reservations.index')->with('error', 'Anda tidak memiliki izin untuk menyetujui reservasi.');
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