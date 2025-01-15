<?php

// app/Models/Paciente.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'tb004_pacientes'; // Nome da tabela no banco de dados

    // Corrigir os campos que podem ser preenchidos
    protected $fillable = [
        'idUser', 'sexo', 'data_nascimento', 'endereco', 'estado_civil', 'plano_saude', 'idMedicoResponsavel'
    ];

    // Defina explicitamente a chave primária como 'idPaciente'
    protected $primaryKey = 'idPaciente';

    // Se o 'idPaciente' for autoincrementável, defina isso explicitamente
    public $incrementing = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'id');
    }
}

