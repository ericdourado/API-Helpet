<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario = new User();
        $usuario->name = 'root';
        $usuario->email = 'root@hotmail.com';
        $usuario->password = bcrypt('root');
        $usuario->ativo = 1;
        $usuario->usuario_id = 1;
        $usuario->perfil_id = 2;
        $usuario->save();
    }
}
