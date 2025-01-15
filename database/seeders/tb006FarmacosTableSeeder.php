<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tb006FarmacosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Desativa a verificação de chaves estrangeiras para truncar a tabela
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');  // Desativa as chaves estrangeiras
        DB::table('tb006_farmacos')->truncate();    // Trunca a tabela
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');  // Restaura as chaves estrangeiras

        // Inserir dados manualmente
        DB::table('tb006_farmacos')->insert([
            ['IdFarmaco' => 1, 'nomeFarmaco' => 'Paracetamol', 'descricao' => 'Analgésico e antitérmico utilizado para dor e febre.'],
            ['IdFarmaco' => 2, 'nomeFarmaco' => 'Ibuprofeno', 'descricao' => 'Anti-inflamatório não esteroide usado para dor e inflamação.'],
            ['IdFarmaco' => 3, 'nomeFarmaco' => 'Amoxicilina', 'descricao' => 'Antibiótico usado para tratar infecções bacterianas.'],
            ['IdFarmaco' => 4, 'nomeFarmaco' => 'Captopril', 'descricao' => 'Anti-hipertensivo usado para tratar pressão alta.'],
            ['IdFarmaco' => 5, 'nomeFarmaco' => 'Metformina', 'descricao' => 'Medicamento usado no controle da diabetes tipo 2.'],
            ['IdFarmaco' => 6, 'nomeFarmaco' => 'Atorvastatina', 'descricao' => 'Reduz os níveis de colesterol no sangue.'],
            ['IdFarmaco' => 7, 'nomeFarmaco' => 'Omeprazol', 'descricao' => 'Reduz a acidez do estômago, usado para úlceras e refluxo.'],
            ['IdFarmaco' => 8, 'nomeFarmaco' => 'Diazepam', 'descricao' => 'Ansiolítico usado para ansiedade e insônia.'],
            ['IdFarmaco' => 9, 'nomeFarmaco' => 'Losartana', 'descricao' => 'Anti-hipertensivo usado no tratamento da pressão alta.'],
            ['IdFarmaco' => 10, 'nomeFarmaco' => 'Azitromicina', 'descricao' => 'Antibiótico usado para infecções respiratórias e outras.'],
            ['IdFarmaco' => 11, 'nomeFarmaco' => 'Cetirizina', 'descricao' => 'Antialérgico usado para tratar alergias e coceira.'],
            ['IdFarmaco' => 12, 'nomeFarmaco' => 'Salbutamol', 'descricao' => 'Broncodilatador usado para tratar asma e dificuldade respiratória.'],
            ['IdFarmaco' => 13, 'nomeFarmaco' => 'Dexametasona', 'descricao' => 'Corticosteroide usado para inflamação e alergias graves.'],
            ['IdFarmaco' => 14, 'nomeFarmaco' => 'Clonazepam', 'descricao' => 'Medicamento usado para ansiedade e distúrbios convulsivos.'],
            ['IdFarmaco' => 15, 'nomeFarmaco' => 'Levotiroxina', 'descricao' => 'Usado no tratamento do hipotireoidismo.'],
            ['IdFarmaco' => 16, 'nomeFarmaco' => 'Aspirina', 'descricao' => 'Analgésico e antiplaquetário usado para dor e prevenção de tromboses.'],
            ['IdFarmaco' => 17, 'nomeFarmaco' => 'Furosemida', 'descricao' => 'Diurético usado no tratamento de retenção de líquidos.'],
            ['IdFarmaco' => 18, 'nomeFarmaco' => 'Prednisona', 'descricao' => 'Corticosteroide usado para inflamação e doenças autoimunes.'],
            ['IdFarmaco' => 19, 'nomeFarmaco' => 'Fluoxetina', 'descricao' => 'Antidepressivo usado para tratar depressão e ansiedade.'],
            ['IdFarmaco' => 20, 'nomeFarmaco' => 'Enalapril', 'descricao' => 'Anti-hipertensivo usado no tratamento da hipertensão e insuficiência cardíaca.'],
        ]);
    }
}
