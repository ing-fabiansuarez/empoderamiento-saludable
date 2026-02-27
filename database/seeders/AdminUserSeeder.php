<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        AdminUser::firstOrCreate(
            ['user' => 'admin'],
            ['password' => Hash::make('admin123')],
        );

        AdminUser::firstOrCreate(
            ['user' => 'andrick.parra@gmail.com'],
            ['password' => Hash::make('Unab2026*')],
        );
    }
}
