<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class Tb005ConsultasTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $consultas = [];

        // A lógica vai garantir que o paciente e o médico sejam válidos
        for ($medico = 1; $medico <= 20; $medico++) {
            $numeroConsulta = 1; // Reinicia a numeração para cada médico

            // Cada médico terá 5 consultas
            for ($i = 1; $i <= 5; $i++) {
                // Garantir que o paciente existe na tabela 'tb004_pacientes'
                $idPaciente = $faker->numberBetween(1, 30);
                // Garantir que o paciente realmente existe na tabela 'tb004_pacientes'
                $pacienteExistente = DB::table('tb004_pacientes')->where('idPaciente', $idPaciente)->exists();

                // Se o paciente não existir, saltamos para o próximo
                if (!$pacienteExistente) {
                    continue;
                }

                // Adiciona consulta válida ao array de consultas
                $consultas[] = [
                    'idMedico' => $medico,
                    'idPaciente' => $idPaciente, // Relaciona com paciente válido
                    'numero_consulta' => $numeroConsulta,
                    'data_consulta' => $faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'), // Gera data dentro do intervalo
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $numeroConsulta++; // Incrementa o número da consulta
            }
        }

        // Inserção das consultas na tabela
        DB::table('tb005_consultas')->insert($consultas);
    }
}
