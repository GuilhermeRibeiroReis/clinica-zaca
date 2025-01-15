<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Farmaco extends Model
{
    //
    protected $table = 'tb006_farmacos'; // Nome da tabela no banco de dados
    protected $fillable = ['nomeFarmaco', 'descricao'];
}
