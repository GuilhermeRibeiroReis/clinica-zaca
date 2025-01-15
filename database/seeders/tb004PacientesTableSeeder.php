<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class Tb004PacientesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Inserir os pacientes na tabela 'users' com idUserTipo = 3 (pacientes)
        $data = [];
        for ($i = 1; $i <= 30; $i++) {
            // Inserir paciente na tabela 'users'
            $userId = DB::table('users')->insertGetId([
                'idUserTipo' => 3, // Paciente
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password' . $i), // Senha padrão
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Agora inserir o paciente na tabela tb004_pacientes
            DB::table('tb004_pacientes')->insert([
                'idUser' => $userId, // Relacionando o idUser com o usuário recém-criado
                'sexo' => $faker->randomElement(['Masculino', 'Feminino', 'Outro']),
                'data_nascimento' => $faker->dateTimeBetween('-90 years', '-18 years')->format('Y-m-d'),
                'endereco' => $faker->address,
                'estado_civil' => $faker->randomElement(['Solteiro(a)', 'Casado(a)', 'Divorciado(a)', 'Viúvo(a)', 'Outro']),
                'plano_saude' => $faker->optional()->word,
                //'contato_emergencia_nome' => $faker->optional()->name,
                //'contato_emergencia_telefone' => $faker->optional()->phoneNumber,
                //'contato_emergencia_relacao' => $faker->optional()->randomElement(['Mãe', 'Pai', 'Amigo', 'Cônjuge']),
                //'observacoes' => $faker->optional()->text,
                'idMedicoResponsavel' => $faker->optional()->numberBetween(1, 10), // Médico responsável (pode ser nulo)
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
