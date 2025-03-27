@extends('layouts.app')

@section('content')
<div class="container" style="background-color: #fff8dc; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
    <h1 class="mb-4 text-center" style="color: #ffcc00; font-weight: bold; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);">Daftar Reservasi</h1>

    @if (Auth::user()->hasRole('User'))
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('reservations.create') }}" class="btn btn-warning" style="font-weight: bold;">Tambah Reservasi</a>
            <p class="text-muted" style="margin: 0;">Total Reservasi: <strong>{{ $reservations->count() }}</strong></p>
        </div>
    @endif

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
                    <th>Status</th>
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
                        <td>
                            @if ($reservation->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif ($reservation->status == 'approved')
                                <span class="badge bg-success">Approved</span>
                            @else
                                <span class="badge bg-danger">Rejected</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if (Auth::user()->hasRole('Admin') && $reservation->status == 'pending')
                                <form action="{{ route('reservations.approve', $reservation->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-success" style="font-weight: bold;">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                </form>
                            @endif
                            @if (Auth::user()->hasRole('User') && $reservation->nama === Auth::user()->name)
                                <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-sm btn-warning" style="font-weight: bold;">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            @endif
                            @if (Auth::user()->hasRole('Admin') || (Auth::user()->hasRole('User') && $reservation->nama === Auth::user()->name))
                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus reservasi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" style="font-weight: bold;">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>
                            @endif
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