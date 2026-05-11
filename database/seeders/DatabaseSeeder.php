<?php

namespace Database\Seeders;

use App\Models\Nomina;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@issste.gob.mx',
            'password' => bcrypt('admin123'),
            'adscripcion' => 'ADMIN',
            'unidad' => 'DELEGACIÓN ESTATAL B.C.',
            'lugar' => 'MEXICALI',
            'titular_area' => 'TITULAR DE ÁREA',
            'pagador_habilitado' => 'PAGADOR HABILITADO',
            'type' => 'admin',
        ]);

        User::create([
            'name' => 'Usuario Demo',
            'email' => 'user@issste.gob.mx',
            'password' => bcrypt('user123'),
            'adscripcion' => 'DEMO',
            'unidad' => 'UNIDAD DEMO',
            'lugar' => 'MEXICALI',
            'titular_area' => 'TITULAR DE ÁREA',
            'pagador_habilitado' => 'PAGADOR HABILITADO',
            'type' => 'member',
        ]);

        Nomina::create([
            'nomina' => 'ORDINARIA QNA 01',
            'fecha_emision' => '2026-01-15',
            'comentario' => 'Primera quincena de enero',
        ]);
    }
}
