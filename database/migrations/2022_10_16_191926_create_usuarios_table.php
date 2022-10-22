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
            $table->string('cpfcnpj',14);
            $table->string('telefone',50);
            $table->string('endereco',50);
            $table->string('cidade',50);
            $table->string('bairro',50);
            $table->integer('numero');
            $table->dateTime('dt_nascimento');
            $table->unsignedBigInteger('user_id');
            $table->tinyint('ativo');
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
