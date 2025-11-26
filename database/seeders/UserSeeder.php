<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Delivery Men
        User::create([
            'name' => 'Delivery Man 1',
            'email' => 'delivery1@example.com',
            'password' => Hash::make('password'),
            'role' => 'delivery_man',
            'address' => 'Warehouse A, Dhaka',
            'lat' => 23.780887,
            'lng' => 90.279237,
        ]);

        User::create([
            'name' => 'Delivery Man 2',
            'email' => 'delivery2@example.com',
            'password' => Hash::make('password'),
            'role' => 'delivery_man',
            'address' => 'Warehouse B, Dhaka',
            'lat' => 23.792500,
            'lng' => 90.407000,
        ]);

        // Customers
        User::create([
            'name' => 'Customer One',
            'email' => 'customer1@example.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'address' => 'Customer Area 1, Dhaka',
            'lat' => 23.794800,
            'lng' => 90.391400,
        ]);

        User::create([
            'name' => 'Customer Two',
            'email' => 'customer2@example.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'address' => 'Customer Area 2, Dhaka',
            'lat' => 23.767900,
            'lng' => 90.356300,
        ]);

        User::create([
            'name' => 'Customer Three',
            'email' => 'customer3@example.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'address' => 'Customer Area 3, Dhaka',
            'lat' => 23.751200,
            'lng' => 90.400200,
        ]);
    }
}
