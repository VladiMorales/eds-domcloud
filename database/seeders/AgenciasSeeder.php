<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AgenciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agencias = [
            'Enlaces del Sur',
            'Xonab',
            'W destinos',
            'Pollo',
            'Paxial',
            'Voy a Chiapas',
            'Chincultik',
            'Popolvu',
            'Turtux',
            'Escudo Jaguar',
            'Viajes al Corazón',
            'Get Viajes',
            'Ávalos',
            'Info Turística',
            'Turística Colonial',
            'Chiapaneca Tours',
            'Camino Travel'
        ];

        foreach ($agencias as $nombre) {
            DB::table('agencias')->insert([
                'nombre' => $nombre,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
