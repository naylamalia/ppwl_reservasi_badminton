@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Reservasi</h1>

    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="courts_id" class="form-label">Pilih Lapangan</label>
            <select name="courts_id" id="courts_id" class="form-select @error('courts_id') is-invalid @enderror" required>
                <option value="">-- Pilih Lapangan --</option>
                @foreach($courts as $court)
                    <option value="{{ $court->id }}" data-harga="{{ $court->harga_per_jam }}" {{ old('courts_id') == $court->id ? 'selected' : '' }}>
                        {{ $court->nama }} - Rp {{ number_format($court->harga_per_jam, 2, ',', '.') }} / jam
                    </option>
                @endforeach
            </select>
            @error('courts_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Pemesan</label>
            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal Reservasi</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}" required>
            @error('tanggal')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="jam_mulai" class="form-label">Jam Mulai</label>
            <input type="time" name="jam_mulai" id="jam_mulai" class="form-control @error('jam_mulai') is-invalid @enderror" value="{{ old('jam_mulai') }}" required>
            @error('jam_mulai')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="jam_selesai" class="form-label">Jam Selesai</label>
            <input type="time" name="jam_selesai" id="jam_selesai" class="form-control @error('jam_selesai') is-invalid @enderror" value="{{ old('jam_selesai') }}" required>
            @error('jam_selesai')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="total_harga" class="form-label">Total Harga</label>
            <input type="text" id="total_harga" class="form-control" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const courtsSelect = document.getElementById('courts_id');
        const jamMulaiInput = document.getElementById('jam_mulai');
        const jamSelesaiInput = document.getElementById('jam_selesai');
        const totalHargaInput = document.getElementById('total_harga');

        function calculateTotalHarga() {
            const selectedCourt = courtsSelect.options[courtsSelect.selectedIndex];
            const hargaPerJam = parseFloat(selectedCourt.getAttribute('data-harga')) || 0;

            const jamMulai = jamMulaiInput.value;
            const jamSelesai = jamSelesaiInput.value;

            if (jamMulai && jamSelesai && hargaPerJam > 0) {
                const startTime = new Date(`1970-01-01T${jamMulai}:00`);
                const endTime = new Date(`1970-01-01T${jamSelesai}:00`);
                const duration = (endTime - startTime) / (1000 * 60 * 60); // Durasi dalam jam

                if (duration > 0) {
                    const totalHarga = duration * hargaPerJam;
                    totalHargaInput.value = `Rp ${totalHarga.toLocaleString('id-ID')}`;
                } else {
                    totalHargaInput.value = 'Durasi tidak valid';
                }
            } else {
                totalHargaInput.value = '';
            }
        }

        courtsSelect.addEventListener('change', calculateTotalHarga);
        jamMulaiInput.addEventListener('input', calculateTotalHarga);
        jamSelesaiInput.addEventListener('input', calculateTotalHarga);
    });
</script>
@endsection