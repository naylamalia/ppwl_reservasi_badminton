@extends('layouts.app')

@section('content')
<div class="container" style="background-color: #fff8dc; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
    <h1 class="mb-4 text-center" style="color: #ffcc00; font-weight: bold; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);">Daftar Lapangan</h1>

    @if (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Admin'))
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('courts.create') }}" class="btn btn-warning" style="font-weight: bold;">Tambah Lapangan</a>
            <p class="text-muted" style="margin: 0;">Total Lapangan: <strong>{{ $courts->count() }}</strong></p>
        </div>
    @endif

    @if($courts->count())
        <table class="table table-hover table-bordered" style="background-color: #fffacd; border-radius: 10px; overflow: hidden;">
            <thead style="background-color: #ffeb99; color: #665c00; font-weight: bold;">
                <tr>
                    <th style="text-align: center;">#</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Harga Per Jam</th>
                    <th>Status</th>
                    <th>Kapasitas</th>
                    @if (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Admin'))
                        <th class="text-center">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($courts as $court)
                    <tr style="vertical-align: middle;">
                        <td style="text-align: center;">{{ $loop->iteration }}</td>
                        <td>{{ $court->nama }}</td>
                        <td>{{ $court->deskripsi }}</td>
                        <td>Rp {{ number_format($court->harga_per_jam, 2, ',', '.') }}</td>
                        <td>{{ ucfirst($court->status) }}</td>
                        <td>{{ $court->kapasitas }}</td>
                        @if (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Admin'))
                            <td class="text-center">
                                <a href="{{ route('courts.edit', $court->id) }}" class="btn btn-sm btn-warning" style="font-weight: bold;">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('courts.destroy', $court->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lapangan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" style="font-weight: bold;">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            {{ $courts->links('pagination::bootstrap-4') }}
        </div>
    @else
        <p class="text-center" style="color: #ffcc00; font-weight: bold; font-size: 18px;">Tidak ada data lapangan.</p>
    @endif
</div>
@endsection