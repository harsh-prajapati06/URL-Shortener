<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement("
            INSERT INTO users (
                name,
                email,
                password,
                role,
                company_id,
                created_at,
                updated_at
            ) VALUES (
                'Super Admin',
                'superadmin@gmail.com',
                '" . Hash::make('password') . "',
                'Super Admin',
                NULL,
                NOW(),
                NOW()
            )
        ");
    }
}
