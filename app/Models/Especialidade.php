<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
    use HasFactory;

    protected $table = 'tb002_especialidades';
    protected $primaryKey = 'idEspecialidade';

    protected $fillable = ['descricao'];

    public function medicos()
    {
        return $this->hasMany(Medico::class, 'idEspecialidade', 'idEspecialidade');
    }
}

