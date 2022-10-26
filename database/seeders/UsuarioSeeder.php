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
        $usuario->cpfcnpj = '123456789153';
        $usuario->telefone = '27996948351';
        $usuario->endereco = 'av cel manoel nunes';
        $usuario->cidade = 'serra';
        $usuario->bairro = 'jardim tropical';
        $usuario->numero = 27;
        $usuario->dt_nascimento = '2002-05-20';
        $usuario->tipo = 1;
        $usuario->ativo = 1;
        $usuario->save();
    }
}
