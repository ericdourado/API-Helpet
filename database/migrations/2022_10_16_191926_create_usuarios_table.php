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
            $table->string('cpfcnpj',14)->nullable();
            $table->string('telefone',50)->nullable();
            $table->string('endereco',50)->nullable();
            $table->string('cidade',50)->nullable();
            $table->string('bairro',50)->nullable();
            $table->integer('numero')->nullable();
            $table->dateTime('dt_nascimento')->nullable();
            $table->integer('Tipo')->nullable();
            $table->boolean('ativo');
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
