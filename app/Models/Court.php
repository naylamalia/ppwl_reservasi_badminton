<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi Laravel
    protected $table = 'courts';

    // Tentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'nama',
        'deskripsi',
        'harga_per_jam',
        'status',
        'jadwal_operasional',
        'kapasitas',
    ];

    // Jika Anda ingin mengakses jadwal operasional sebagai array
    protected $casts = [
        'jadwal_operasional' => 'array',
    ];

    // Relasi dengan model Reservation
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}