<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courts', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255);
            $table->text('deskripsi')->nullable();
            $table->decimal('harga_per_jam', 10, 2);
            $table->enum('status', ['tersedia', 'tidak tersedia'])->default('tersedia');
            $table->json('jadwal_operasional')->nullable();
            $table->integer('kapasitas')->default(4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courts');
    }
};
