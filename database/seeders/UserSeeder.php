<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create the admin user first to ensure its specific phone number is taken.
        User::create([
            'nom' => 'Admin',
            'prenom' => 'User',
            'pays' => 'Burkina Faso',
            'phone' => '70000000',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // You should change this in production
            'email_verified_at' => now(),
        ]);

        // Then create additional random users. The factory should generate unique phone numbers.
        // If a collision still occurs, it means fake()->unique()->phoneNumber() is not robust enough
        // or the range of generated numbers is too small.
        User::factory(10)->create();
    }
}