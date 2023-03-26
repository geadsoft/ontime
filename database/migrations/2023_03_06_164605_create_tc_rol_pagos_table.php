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
        Schema::create('tc_rol_pagos', function (Blueprint $table) {
            $table->id();
            $table->datetime('fecha');
            $table->integer('mes');
            $table->integer('periodo');
            $table->unsignedBigInteger('tiposrol_id')->unsigned();
            $table->unsignedBigInteger('periodosrol_id')->unsigned();
            $table->string('remuneracion',1);
            $table->double('ingresos',14,2);
            $table->double('egresos',14,2);
            $table->double('total',14,2);
            $table->string('usuario',50);
            $table->string('estado',1);
            $table->timestamps();

            $table->foreign('tiposrol_id')->references('id')->on('tm_tiposrols');
            $table->foreign('periodosrol_id')->references('id')->on('tm_periodosrols');
            
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tc_rol_pagos');
    }
};
