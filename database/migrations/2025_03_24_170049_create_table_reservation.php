<?php

use Illuminate\Database\Migrations\Migration; 
use Illuminate\Database\Schema\Blueprint; 
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{ 
    /** * Run the migrations. */ 

    public function up(): void 
    { Schema::create('reservations', function (Blueprint $table) {
        $table->id(); 
        $table->foreignId('courts_id')->constrained()->onDelete('cascade'); // Relasi ke tabel lapangans 
        $table->string('nama', 255); // nama pemesan 
        $table->date('tanggal'); // Tanggal reservasi 
        $table->time('jam_mulai'); // Jam mulai pemakaian lapangan 
        $table->time('jam_selesai'); // Jam selesai pemakaian lapangan 
        $table->integer('total_harga'); // Total harga berdasarkan durasi 
        $table->timestamps(); }); 
    }

        /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations'); // Menghapus tabel reservations, bukan courts
    }
};