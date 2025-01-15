<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb001_medicos', function (Blueprint $table) {
            $table->id('idMedico'); // ID do médico
            $table->unsignedBigInteger('idEspecialidade'); // Relacionamento com especialidades
            $table->unsignedBigInteger('idUser'); // Relacionamento com o usuário (tabela users)
            $table->string('telefone', 50)->nullable(); // Telefone (pode ser nulo)
            $table->timestamps(); // Campos de created_at e updated_at

            // Definir a chave estrangeira para a especialidade
            $table->foreign('idEspecialidade')
                  ->references('idEspecialidade')
                  ->on('tb002_especialidades')
                  ->onDelete('cascade');

            // Definir a chave estrangeira para o usuário (tabela users)
            $table->foreign('idUser')
                  ->references('id')  // Referencia a coluna 'id' da tabela 'users'
                  ->on('users')  // Referencia a tabela 'users'
                  ->onDelete('cascade');  // Quando o usuário for excluído, exclui o médico também
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb001_medicos');
    }
};
