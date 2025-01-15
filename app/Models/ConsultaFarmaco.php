<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultaFarmaco extends Model
{
    protected $table = 'tb007_consultas_farmacos';

    // A tabela não possui um campo 'id' como chave primária, mas sim uma chave composta
    public $incrementing = false;  // Desativa a auto-incrementação, pois estamos usando chave composta

    protected $primaryKey = ['idConsulta', 'idFarmaco']; // Definir a chave primária composta

    public $timestamps = false;  // Desabilita os timestamps (created_at, updated_at)

    // Define os campos que podem ser preenchidos
    protected $fillable = ['idConsulta', 'idFarmaco'];

    // Relacionamento com a consulta
    public function consulta()
    {
        return $this->belongsTo(Consulta::class, 'idConsulta', 'idConsulta');
    }

    // Relacionamento com o farmácio
    public function farmaco()
    {
        return $this->belongsTo(Farmaco::class, 'idFarmaco', 'idFarmaco');
    }
}
