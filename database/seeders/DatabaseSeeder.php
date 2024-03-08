<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\UserRoleEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => "admin",
            'email' => "admin@email.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'status' =>1,
            'role' => UserRoleEnum::ADMIN, 
            'remember_token' => Str::random(10),
        ]);
    }
}
