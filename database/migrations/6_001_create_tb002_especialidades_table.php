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
        Schema::create('tb002_especialidades', function (Blueprint $table) {
            $table->id('idEspecialidade'); // ID da especialidade
            $table->string('descricao'); // Descrição da especialidade
            $table->timestamps(); // Campos de created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb002_especialidades');
    }
};
