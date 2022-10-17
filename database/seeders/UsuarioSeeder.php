<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario = new Usuario();
        $usuario->nome = 'teste';
        $usuario->cpf = '123456789153';
        $usuario->telefone = '27996948351';
        $usuario->endereco = 'av cel manoel nunes';
        $usuario->dt_nascimento = '2002-05-20';
        $usuario->sexo = 'Masculino';
        $usuario->user_id = 1;
        $usuario->Ativo = 1;
        $usuario->save();
    }
}
