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
        Schema::create('adocao', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('adotante_usuario_id')->nullable();
            $table->unsignedBigInteger('anunciante_usuario_id');
            $table->string('nome')->nullable();
            $table->string('especie')->nullable();
            $table->string('cor')->nullable();
            $table->string('porte')->nullable();
            $table->integer('idade')->nullable();
            $table->tinyInteger('adotado')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
        Schema::table('adocao', function (Blueprint $table) {
            $table->foreign('adotante_usuario_id')->references('id')->on('usuarios');
            $table->foreign('anunciante_usuario_id')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adocao');
    }
};
