<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tb002EspecialidadesTableSeeder extends Seeder
{
    public function run()
    {
        // Inserir dados manualmente
        DB::table('tb002_especialidades')->insert([
            ['IDespecialidade' => 1, 'descricao' => 'Cardiologia'],
            ['IDespecialidade' => 2, 'descricao' => 'Neurologia'],
            ['IDespecialidade' => 3, 'descricao' => 'Pediatria'],
            ['IDespecialidade' => 4, 'descricao' => 'Ortopedia'],
            ['IDespecialidade' => 5, 'descricao' => 'Ginecologia'],
        ]);
    }
}