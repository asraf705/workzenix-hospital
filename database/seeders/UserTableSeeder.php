<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        // Create a default regular user
        User::create([
            'name' => 'User',
            'email' => 'user@tipinfotrove.com',
            'password' => Hash::make('12345678'), // Use a secure password
        ]);
    }
}