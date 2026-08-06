<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'a@gmail.com'],
            [
                'name' => 'User A',
                'password' => Hash::make('123@123a'),
                'is_active' => true,
                'role' => 'super_admin',
            ]
        );
    }
}