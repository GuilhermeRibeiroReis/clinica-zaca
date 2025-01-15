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
        Schema::create('tb005_consultas', function (Blueprint $table) {
            $table->id('idConsulta');
            $table->unsignedBigInteger('idMedico');
            $table->unsignedBigInteger('idPaciente');
            //$table->unsignedBigInteger('idUser');
            $table->integer('numero_consulta');
            $table->date('data_consulta');
            $table->string('status')->nullable()->default('Agendada');
            $table->timestamps();

            // Definir as chaves estrangeiras
            $table->foreign('idMedico')->references('idMedico')->on('tb001_medicos')->onDelete('cascade');

            //$table->foreign('idPaciente')->references('idPaciente')->on('tb004_pacientes')->onDelete('cascade');
            $table->foreign('idPaciente')->references('idPaciente')->on('tb004_pacientes')->onDelete('cascade');
            
            // Índice único composto
            $table->unique(['idMedico', 'idPaciente', 'numero_consulta']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb005_consultas');
    }
};
