<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ZonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $zonas = [
            'Terminal Miguel Hidalgo',
            'Terminal Boulevard',
            'Central de Pasajeros',
            'Enlaces Express'
        ];

        foreach ($zonas as $zona){
            DB::table('zonas')->insert([
                'direccion' => $zona,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
