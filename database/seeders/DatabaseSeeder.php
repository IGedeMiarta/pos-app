<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Company::create([
            'name' => 'HOLOGRAM SCREEN PRINTING',
            'address'=>'Jl. Jempiring No.32, Baler Bale Agung, Negara.',
            'phone' => "+62 878 6183 3966",
        ]);
    }
}
