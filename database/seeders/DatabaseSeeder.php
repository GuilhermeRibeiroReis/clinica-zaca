<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserTipo;  // Alteração: Usar a classe UserTipo que você definiu no modelo
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Chamando outros seeders
        $this->call(tb000UserTipoSeeder::class);
        $this->call(tb002EspecialidadesTableSeeder::class);
        $this->call(tb001MedicosTableSeeder::class);
        $this->call(tb006FarmacosTableSeeder::class);
        $this->call(tb003AdministrativosTableSeeder::class);
        $this->call(tb004PacientesTableSeeder::class);
        $this->call(tb005ConsultasTableSeeder::class);
        $this->call(tb006FarmacosTableSeeder::class);


        // Criando o usuário administrador
        $adminTipo = UserTipo::where('descricao', 'admin')->first();  // Usando a classe correta UserTipo

        if ($adminTipo) {  // Verifica se o tipo 'admin' foi encontrado
            User::factory()->create([
                'name' => 'Administrador',
                'email' => 'admin@example.com',
                'password' => bcrypt('12345678'),  // Senha criptografada
                'idUserTipo' => $adminTipo->idUserTipo,  // Associa o usuário ao tipo 'admin' usando a chave estrangeira
            ]);
        } else {
            // Caso o tipo 'admin' não exista na tabela, exibe uma mensagem
            echo "Tipo de usuário 'admin' não encontrado.\n";
        }
    }
}
