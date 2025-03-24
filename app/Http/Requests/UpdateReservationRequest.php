<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id', // Validasi relasi ke tabel users
            'courts_id' => 'required|exists:courts,id', // Validasi relasi ke tabel courts
            'nama' => 'required|string|max:255', // Nama pemesan wajib diisi
            'tanggal' => 'required|date', // Tanggal reservasi wajib diisi
            'jam_mulai' => 'required|date_format:H:i', // Jam mulai wajib diisi dengan format waktu
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai', // Jam selesai harus setelah jam mulai
            'total_harga' => 'required|integer|min:0', // Total harga wajib diisi dan harus angka positif
        ];
    }
}