<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTipo extends Model
{
    use HasFactory;

    protected $table = 'tb008_user_tipo';  // Certifique-se de que o nome da tabela está correto

    // Caso a chave primária tenha um nome diferente
    protected $primaryKey = 'idUserTipo';
    
    // Se o modelo não usar timestamps (created_at e updated_at), adicione a linha abaixo
    public $timestamps = false;
}
