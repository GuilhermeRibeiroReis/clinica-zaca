<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;
    protected $table = 'tb001_medicos';
    protected $primaryKey = 'idMedico';
    //protected $fillable = ['idEspecialidade', 'nomeMedico', 'email', 'telefone'];
    protected $fillable = ['idEspecialidade', 'telefone'];

    public function especialidade()
    {
        return $this->belongsTo(Especialidade::class, 'idEspecialidade', 'idEspecialidade');
    }

    // Definir a relação com o modelo User
    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');  // Defina a chave estrangeira corretamente
    }
    
    // Relacionamento com as consultas
    public function consultas()
    {
        return $this->hasMany(Consulta::class, 'idMedico', 'idMedico');
    }

}

