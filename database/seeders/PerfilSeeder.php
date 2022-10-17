<?php

namespace Database\Seeders;

use App\Models\Perfil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perfil = new Perfil();
        $perfil->nome_perfil = 'master';
        $perfil->save();

        $perfil2 = new Perfil();
        $perfil2->nome_perfil = 'basico';
        $perfil2->save();
    }
}
