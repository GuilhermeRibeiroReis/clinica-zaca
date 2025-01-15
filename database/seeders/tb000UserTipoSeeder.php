<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Certifique-se de importar a facade DB

class tb000UserTipoSeeder extends Seeder
{
    public function run()
    {
        // Inserir tipos de usuários
        DB::table('tb008_user_tipo')->insert([
            ['descricao' => 'admin'],
            ['descricao' => 'medico'],
            ['descricao' => 'paciente'],
        ]);
    }
}
