<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure only one SuperAdmin exists
        DB::table('users')->where('role', 'SuperAdmin')->delete();

        // Insert SuperAdmin using raw SQL (MySQL compatible)
        DB::insert(
            "INSERT INTO users (name, email, password, role, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())",
            [
                'Super Admin',
                'superadmin@example.com',
                Hash::make('password'),
                'SuperAdmin',
            ]
        );
    }
}
