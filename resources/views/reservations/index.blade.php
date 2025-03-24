@extends('layouts.app')

@section('content')
<div class="container" style="background-color: #fff8dc; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
    <h1 class="mb-4 text-center" style="color: #ffcc00; font-weight: bold; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);">Daftar Reservasi</h1>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('reservations.create') }}" class="btn btn-warning" style="font-weight: bold;">Tambah Reservasi</a>
        <p class="text-muted" style="margin: 0;">Total Reservasi: <strong>{{ $reservations->count() }}</strong></p>
    </div>

    @if($reservations->count())
        <table class="table table-hover table-bordered" style="background-color: #fffacd; border-radius: 10px; overflow: hidden;">
            <thead style="background-color: #ffeb99; color: #665c00; font-weight: bold;">
                <tr>
                    <th style="text-align: center;">#</th>
                    <th>Nama Pemesan</th>
                    <th>Lapangan</th>
                    <th>Tanggal</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Total Harga</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                    <tr style="vertical-align: middle;">
                        <td style="text-align: center;">{{ $loop->iteration }}</td>
                        <td>{{ $reservation->nama }}</td>
                        <td>{{ $reservation->court->nama }}</td>
                        <td>{{ $reservation->tanggal }}</td>
                        <td>{{ $reservation->jam_mulai }}</td>
                        <td>{{ $reservation->jam_selesai }}</td>
                        <td>Rp {{ number_format($reservation->total_harga, 2, ',', '.') }}</td>
                        <td class="text-center">
                            <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-sm btn-warning" style="font-weight: bold;">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus reservasi ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" style="font-weight: bold;">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            {{ $reservations->links('pagination::bootstrap-4') }}
        </div>
    @else
        <p class="text-center" style="color: #ffcc00; font-weight: bold; font-size: 18px;">Tidak ada data reservasi.</p>
    @endif
</div>
@endsection