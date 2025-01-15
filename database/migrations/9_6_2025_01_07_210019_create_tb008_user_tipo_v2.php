<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tb008_user_tipo', function (Blueprint $table) {
            $table->id('idUserTipo');
            $table->string('descricao')->unique();  // Ex: "admin", "medico", "paciente"
            $table->timestamps();
        });

        // Agora adicionamos a chave estrangeira para a tabela que faz referência a tb008_user_tipo
        //Schema::table('tb001_medicos', function (Blueprint $table) {
        //    $table->foreignId('idUserTipo')  // Criando a coluna para a chave estrangeira
        //        ->nullable()  // Pode ser nula
        //        ->constrained('tb008_user_tipo', 'idUserTipo')  // Referenciando a tabela tb008_user_tipo e o campo idUserTipo
        //        ->onDelete('cascade');  // Quando o tipo de usuário for excluído, todos os médicos associados serão excluídos
        //});
        
    }

    public function down()
    {
        // Atualiza os médicos para ter 'null' no campo idUserTipo
        //DB::table('tb001_medicos')->update(['idUserTipo' => null]);
        Schema::dropIfExists('tb008_user_tipo');
    }
};
