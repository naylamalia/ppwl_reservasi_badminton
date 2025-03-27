<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi Laravel
    protected $table = 'reservations';

    // Tentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'courts_id',
        'nama',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'total_harga',
        'status', // Tambahkan kolom status
    ];

    // Relasi dengan model Lapangan
    public function court()
    {
        return $this->belongsTo(Court::class, 'courts_id');
    }
}