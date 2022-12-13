<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adocao extends Model
{
    use HasFactory;
    protected $table = 'adocao';
    protected $fillable = [
            'adotante_usuario_id',
            'anunciante_usuario_id' ,
            'nome' ,
            'especie' ,
            'cor' ,
            'porte',
            'idade' ,
            'adotado'
    ];

}
