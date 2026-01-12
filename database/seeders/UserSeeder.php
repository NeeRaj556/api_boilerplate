<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Job Portal Admin',
            'username' => 'JobPortalAdmin',
            'email' => 'job@admin.com',
            'phone' => '+1234567890',
            'password' => Hash::make('jobportal#$@12#$45'),
            'role' => 'admin',
            'address' => 'Admin Office',
            'email_verified_at' => now(),
        ]);
    }
}
