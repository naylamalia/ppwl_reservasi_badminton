<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourtRequest extends FormRequest
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
            'nama' => 'required|string|max:255', // Nama lapangan wajib diisi
            'deskripsi' => 'nullable|string', // Deskripsi opsional
            'harga_per_jam' => 'required|numeric|min:0', // Harga per jam wajib diisi dan harus angka positif
            'status' => 'required|in:tersedia,tidak tersedia', // Status wajib diisi dengan nilai tertentu
            'jadwal_operasional' => 'nullable|json', // Jadwal operasional opsional, harus berupa JSON
            'kapasitas' => 'required|integer|min:1', // Kapasitas wajib diisi, minimal 1
        ];
    }
}