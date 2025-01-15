<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Especialidade;

class Tb001MedicosTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $data = [];
        for ($i = 1; $i <= 20; $i++) {
            // Criar um usuário para o médico
            $user = User::create([
                'name' => $faker->name, // Nome do médico
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),  // Senha padrão
                'idUserTipo' => 2,  // Supondo que "2" seja o tipo "médico" na tabela tb008_user_tipo
            ]);

            // Escolher uma especialidade aleatória
            $especialidade = Especialidade::inRandomOrder()->first(); // Seleciona uma especialidade aleatória

            // Adicionar o médico à tabela
            $data[] = [
                'idMedico' => $i,
                'idEspecialidade' => $especialidade->idEspecialidade, // Relaciona com a especialidade
                //'nomeMedico' => $user->name, // Nome do médico
                //'email' => $user->email, // Email do usuário (médico)
                'telefone' => $faker->optional()->phoneNumber, // Telefone pode ser nulo
                'idUser' => $user->id,  // Associando o médico ao usuário criado
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Inserir os dados na tabela tb001_medicos
        DB::table('tb001_medicos')->insert($data);
    }
}
