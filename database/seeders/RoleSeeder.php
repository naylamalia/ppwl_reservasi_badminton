<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat daftar izin (permissions)
        $permissions = [
            'create-court',
            'edit-court',
            'delete-court',
            'view-court',
            'create-reservation',
            'edit-reservation',
            'delete-reservation',
            'view-reservation',
            'approve-reservation',
        ];

        // Membuat izin jika belum ada
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Membuat peran (roles)
        $superadmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $user = Role::firstOrCreate(['name' => 'User']);

        // Memberikan semua izin ke Super Admin
        $superadmin->givePermissionTo(Permission::all());

        // Memberikan izin tertentu ke Admin
        $admin->givePermissionTo([
            'create-court',
            'edit-court',
            'delete-court',
            'view-court',
            'edit-reservation',
            'delete-reservation',
            'view-reservation',
            'approve-reservation',
        ]);

        // Memberikan izin tertentu ke User
        $user->givePermissionTo([
            'view-court',
            'create-reservation',
            'edit-reservation',
            'delete-reservation',
        ]);
    }
}