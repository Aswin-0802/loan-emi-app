<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\LoanDetailsTableSeeder;
use Database\Seeders\UsersTableSeeder;



class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            LoanDetailsTableSeeder::class,
            UsersTableSeeder::class,
        ]); 
    }
}
