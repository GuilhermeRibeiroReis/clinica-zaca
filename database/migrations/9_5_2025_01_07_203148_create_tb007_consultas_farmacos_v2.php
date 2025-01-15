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
        Schema::create('tb007_consultas_farmacos', function (Blueprint $table) {
            // Definir as colunas da tabela
            $table->unsignedBigInteger('idConsulta'); // Chave estrangeira para tb005_consultas
            $table->unsignedBigInteger('idFarmaco'); // Chave estrangeira para tb006_farmacos

            // Definir as chaves estrangeiras
            $table->foreign('idConsulta')->references('idConsulta')->on('tb005_consultas')->onDelete('cascade');
            $table->foreign('idFarmaco')->references('idFarmaco')->on('tb006_farmacos')->onDelete('cascade');

            // Definir a chave primária composta
            $table->primary(['idConsulta', 'idFarmaco']);
        });
    }

    public function down()
    {
        // Drop da tabela tb007_consultas_farmacos
        Schema::dropIfExists('tb007_consultas_farmacos');
    }
};
