<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'MD. MUTASIM NAIB',
            'email' => 'test1@gmail.com',
            'phone' => '01794973736',
            'password' => Hash::make('123456'),
            'role' => 2,
        ]);
    }
}
