<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Para hash de senhas

class Tb003AdministrativosTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tb003_administrativos')->insert([
            [
                'idAdministrativo' => 1,
                'telefone' => '351915464442',
                'salario' => '1500',
            ],
            [
                'idAdministrativo' => 2,
                'telefone' => '0987654321',
                'salario' => '1800',
            ],
            [
                'idAdministrativo' => 3,
                'telefone' => null, // Sem telefone
                'salario' => '2500',
            ],
        ]);
    }
}