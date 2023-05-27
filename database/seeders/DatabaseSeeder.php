<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Admin',
            'username'=> 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('123123'),
        ]);
        
        Company::create([
            'name' => 'HOLOGRAM SCREEN PRINTING',
            'address'=>'Jl. Jempiring No.32, Baler Bale Agung, Negara.',
            'phone' => "+62 878 6183 3966",
        ]);
    }
}
