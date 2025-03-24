<!-- filepath: c:\laragon\www\uts_ppwl\resources\views\courts\show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Lapangan</h1>

    <div class="card">
        <div class="card-header">
            <h2>{{ $court->nama }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Deskripsi:</strong> {{ $court->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
            <p><strong>Harga Per Jam:</strong> Rp {{ number_format($court->harga_per_jam, 2, ',', '.') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($court->status) }}</p>
            <p><strong>Kapasitas:</strong> {{ $court->kapasitas }} orang</p>
            <p><strong>Jadwal Operasional:</strong></p>
            <pre>{{ $court->jadwal_operasional ?? 'Tidak ada jadwal operasional.' }}</pre>
        </div>
        <div class="card-footer">
            <a href="{{ route('courts.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('courts.edit', $court->id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection