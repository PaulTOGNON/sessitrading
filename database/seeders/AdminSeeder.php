<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@sessitrading.com'],
            [
                'first_name' => 'Admin',
                'last_name' => 'Sessitrading',
                'name' => 'Admin Sessitrading',
                'phone_number' => '+22900000000',
                'address' => 'Boutique Sessitrading, Cotonou',
                'city' => 'Cotonou',
                'country' => 'Bénin',
                'password' => Hash::make('AdminSecurePassword2026!'),
                'is_admin' => true,
            ]
        );
    }
}
