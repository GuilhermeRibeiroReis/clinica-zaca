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
        Schema::create('tb004_pacientes', function (Blueprint $table) {
            $table->id('idPaciente');
            $table->unsignedBigInteger('idUser'); // Relacionamento com o usuário (tabela users)
            $table->enum('sexo', ['Masculino', 'Feminino', 'Outro'])->nullable();
            $table->date('data_nascimento'); // Data de nascimento
            $table->text('endereco'); // Endereço (campo de texto maior)
            $table->enum('estado_civil', ['Solteiro(a)', 'Casado(a)', 'Divorciado(a)', 'Viúvo(a)', 'Outro'])->nullable(); // Estado civil
            $table->string('plano_saude')->nullable(); // Plano de saúde
            $table->unsignedBigInteger('idMedicoResponsavel')->nullable(); // Médico responsável
            $table->timestamps();

            // Chave estrangeira para a tabela 'users'
            $table->foreign('idUser')->references('id')->on('users')->onDelete('cascade'); // Quando o usuário for excluído, o paciente também será excluído.
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb004_pacientes');
    }
};
