<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Manajemen User
            'create-role',
            'edit-role',
            'delete-role',
            'create-user',  
            'edit-user',
            'delete-user',

            // Manajemen Lapangan
            'create-court',      // Permission untuk membuat lapangan
            'edit-court',        // Permission untuk mengedit lapangan
            'delete-court',      // Permission untuk menghapus lapangan
            'view-court',        // Permission untuk melihat lapangan

            // Manajemen Reservasi
            'create-reservation',     // Permission untuk membuat reservasi
            'edit-reservation',       // Permission untuk mengedit reservasi
            'delete-reservation',     // Permission untuk menghapus reservasi
            'view-reservation',       // Permission untuk melihat reservasi
            'approve-reservation',    // Permission untuk admin menyetujui pemesanan
        ];

        // Looping dan memasukkan permission ke dalam tabel permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}