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
            ['user' => 'fsuarez120@unab.edu.co'],
            ['password' => Hash::make('Qwerty123456*')],
        );

        AdminUser::firstOrCreate(
            ['user' => 'andrick.parra@gmail.com'],
            ['password' => Hash::make('Unab2026*')],
        );
    }
}
