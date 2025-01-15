<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrativo extends Model
{
    use HasFactory;

    protected $table = 'tb003_administrativos'; // Nome da tabela

    protected $fillable = [
        'idAdministrativo', // Referencia à tabela 'users' para o id
        'telefone',
        'salario',
    ];

    public $timestamps = true;
}