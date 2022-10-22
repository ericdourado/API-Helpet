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
        'user_id',
        'cidade',
        'bairro',
        'numero'
    ];

    public function rules(): array
    {
        return [
            'name' => "required|",
            'email' => "required|email|unique:users|",
            'password' => "required|min:8|max:15",
            'nome' =>'required|',
            'cpf' => 'required|cpf',
            'telefone' => 'required|',
            'endereco' => 'required|',
            'dt_nascimento' => 'required|',
            'sexo' => 'required|',
            'user_id' => 'required|',
            'Ativo' => 'required|'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório!',
            'email' => 'Este campo não é um email válido',
            'numeric' => 'O campo :attribute deve ser um número!',
            'min' => 'O campo :attribute deve ter no mínimo :min caracteres!',
            'max' => 'O campo :attribute deve ter no maximo :max caracteres!',
            'type.required' => 'O campo "tipo" é obrigatório!',
            'unique' => 'Este :attribute não se encontra disponivel no momento!'
        ];
    }



    public function User()
    {
        return $this->belongsTo('App\Models\User');
    }
}
