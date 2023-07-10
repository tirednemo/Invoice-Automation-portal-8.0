<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => '1',
            'name' => 'John Doe',
            'email' => 'doejohn@gmail.com',
            'password' => Hash::make('1234567890'),
        ]);
    }
}
