<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\AgenciasSeeder;
use Database\Seeders\ZonaSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {        

        $this->call([
            AgenciasSeeder::class,
            ZonaSeeder::class,
        ]);        
    }
}
