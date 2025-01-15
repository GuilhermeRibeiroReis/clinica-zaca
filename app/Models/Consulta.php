<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    // Define a chave primária como 'idConsulta' (em vez de 'id')
    protected $primaryKey = 'idConsulta';

    // Define o nome da tabela associada ao modelo
    protected $table = 'tb005_consultas';

    // Define as colunas que podem ser preenchidas via mass-assignment
    protected $fillable = ['idMedico', 'idUser', 'idPaciente', 'numero_consulta', 'data_consulta']; // Inclua 'idPaciente' aqui

    // Relacionamento com o modelo 'Medico'
    public function medico()
    {
        return $this->belongsTo(Medico::class, 'idMedico', 'idMedico');
    }

    // Relacionamento com o modelo 'User' (paciente)
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'idPaciente', 'idPaciente');
    }

    // Para garantir que o timestamp seja armazenado automaticamente
    public $timestamps = true;
}
