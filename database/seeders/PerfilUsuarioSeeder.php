<?php

namespace Database\Seeders;

use App\Models\PerfilUsuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerfilUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perfilUsuario = new PerfilUsuario();
        $perfilUsuario->usuario_id = 1;
        $perfilUsuario->perfil_id = 2;
        $perfilUsuario->save();
    }
}
