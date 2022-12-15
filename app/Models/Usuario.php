<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected $fillable = [
        'cpfcnpj',
        'telefone',
        'endereco',
        'dt_nascimento',
        'Tipo',
        'cidade',
        'bairro',
        'numero',
        'cep',
        'estado'
    ];

    public function rules(): array
    {
        return [
            'name' => "required|",
            'email' => "required|email|unique:users|",
        ];
    }


    public function User()
    {
        return $this->belongsTo('App\Models\User');
    }
}
