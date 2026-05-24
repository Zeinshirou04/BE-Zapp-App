<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'              => 'Zayn',
            'email'             => 'zayn@zapp.web.id',
            'password'          => Hash::make('password'),
            'avatar_url'        => 'images/default-avatar.png',
            'role'              => 'admin',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name'              => 'Contributor',
            'email'             => 'contributor@zapp.web.id',
            'password'          => Hash::make('password'),
            'avatar_url'        => 'images/default-avatar.png',
            'role'              => 'contributor',
            'email_verified_at' => now(),
        ]);
    }
}
