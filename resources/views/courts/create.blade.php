<!-- filepath: c:\laragon\www\uts_ppwl\resources\views\courts\create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Lapangan</h1>

    <form action="{{ route('courts.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lapangan</label>
            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="harga_per_jam" class="form-label">Harga Per Jam</label>
            <input type="number" name="harga_per_jam" id="harga_per_jam" class="form-control @error('harga_per_jam') is-invalid @enderror" value="{{ old('harga_per_jam') }}" required>
            @error('harga_per_jam')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="tidak tersedia" {{ old('status') == 'tidak tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="jadwal_operasional" class="form-label">Jadwal Operasional (JSON)</label>
            <textarea name="jadwal_operasional" id="jadwal_operasional" class="form-control @error('jadwal_operasional') is-invalid @enderror">{{ old('jadwal_operasional') }}</textarea>
            @error('jadwal_operasional')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="kapasitas" class="form-label">Kapasitas</label>
            <input type="number" name="kapasitas" id="kapasitas" class="form-control @error('kapasitas') is-invalid @enderror" value="{{ old('kapasitas', 4) }}" required>
            @error('kapasitas')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('courts.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection