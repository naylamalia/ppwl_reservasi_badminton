<!-- filepath: c:\laragon\www\uts_ppwl\resources\views\reservations\show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Reservasi</h1>

    <div class="card">
        <div class="card-header">
            <h2>Reservasi oleh {{ $reservation->nama }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Lapangan:</strong> {{ $reservation->court->nama }}</p>
            <p><strong>Tanggal:</strong> {{ $reservation->tanggal }}</p>
            <p><strong>Jam Mulai:</strong> {{ $reservation->jam_mulai }}</p>
            <p><strong>Jam Selesai:</strong> {{ $reservation->jam_selesai }}</p>
            <p><strong>Total Harga:</strong> Rp {{ number_format($reservation->total_harga, 2, ',', '.') }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection