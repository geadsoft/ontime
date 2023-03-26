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
        Schema::create('td_rol_pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rolpago_id')->unsigned();
            $table->datetime('fecha');
            $table->integer('mes');
            $table->integer('periodo');
            $table->string('remuneracion',1);
            $table->string('registro',1);
            $table->unsignedBigInteger('persona_id')->unsigned();
            $table->unsignedBigInteger('rubrosrol_id')->unsigned()->nullable();
            $table->string('tipo',1);
            $table->string('rubro_total',6)->nullable();
            $table->double('valor',14,2);
            $table->string('usuario',50);
            $table->string('estado',1);
            $table->timestamps();

            $table->foreign('rolpago_id')->references('id')->on('tc_rol_pagos');
            $table->foreign('rubrosrol_id')->references('id')->on('tm_rubrosrols');
            $table->foreign('persona_id')->references('id')->on('tm_personas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('td_rol_pagos');
    }
};

?>
