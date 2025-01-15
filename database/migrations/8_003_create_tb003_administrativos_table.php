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
        Schema::create('tb003_administrativos', function (Blueprint $table) {
            $table->unsignedBigInteger('idAdministrativo'); // Cria a coluna 'id' como chave primária com auto-incremento
            //$table->string('nomeAdministrativo', 100); // Nome do administrativo
            $table->string('telefone', 15)->nullable(); // Telefone (pode ser nulo)
            //$table->string('email', 100)->unique(); // E-mail único
            $table->decimal('salario', 10, 2); // salario
            $table->timestamps(); // Campos 'created_at' e 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb003_administrativos');
    }
};
