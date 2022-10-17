<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome',50);
            $table->string('cpf',50);
            $table->string('telefone',50);
            $table->string('endereco',50);
            $table->dateTime('dt_nascimento');
            $table->string('sexo', 10);
            $table->unsignedBigInteger('user_id');
            $table->boolean('Ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};
