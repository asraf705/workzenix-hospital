<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    public function run()
    {
        // Create a default admin user
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@tipinfotrove.com',
            'password' => Hash::make('12345678'), // Use a secure password
        ]);
    }
}