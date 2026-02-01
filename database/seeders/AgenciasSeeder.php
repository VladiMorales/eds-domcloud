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
            'Xonab',
            'W destinos',
            'Pollo',
            'Paxial',
            'Voy a Chiapas',
            'Chincultik',
            'Popolvu',
            'Turtux',
            'Escudo Jaguar',
            'Viajes al corazón',
            'Get viajes',
            'Ávalos',
            'Info turística',
            'Turística colonia',
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
