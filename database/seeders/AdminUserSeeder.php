<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'), // Change this to a secure password
            'is_admin' => true, // Assuming you have an is_admin field in your users table
            'api_token' => Str::random(60), // Generate a random API token
        ]);
    }
}