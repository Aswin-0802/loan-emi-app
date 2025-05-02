<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Developer',
            'email' => 'developer@example.com',
            'password' => Hash::make('Test@Password123#'),
        ]);
    }
}
