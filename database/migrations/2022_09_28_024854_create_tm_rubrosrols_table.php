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
        Schema::create('tm_rubrosrols', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion',150);
            $table->string('tipo',1);
            $table->string('registro',2);
            $table->boolean('regplanilla');
            $table->string('etiqueta',30);
            $table->boolean('imprimerol1');
            $table->boolean('imprimerol2');
            $table->boolean('imprimerol3');
            $table->string('variable1');
            $table->double('importe',14,6);
            $table->string('variable2');
            $table->double('constante',14,6);
            $table->string('estado',1);
            $table->string('usuario',50);
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
        Schema::dropIfExists('tm_rubrosrols');
    }
};
