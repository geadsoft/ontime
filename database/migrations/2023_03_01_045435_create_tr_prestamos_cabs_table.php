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
        Schema::create('tr_prestamos_cabs', function (Blueprint $table) {
            $table->id();
            $table->datetime('fecha');
            $table->unsignedBigInteger('persona_id')->unsigned();
            $table->unsignedBigInteger('tipoprestamo_id')->unsigned();
            $table->unsignedBigInteger('rubrosrol_id')->unsigned();
            $table->unsignedBigInteger('periodosrol_id')->unsigned();
            $table->double('monto',14,2);
            $table->integer('cuota');
            $table->string('comentario',150);
            $table->string('estado',1);
            $table->string('usuario',50);
            $table->timestamps();

            $table->foreign('persona_id')->references('id')->on('tm_personas');
            $table->foreign('tipoprestamo_id')->references('id')->on('tm_catalogogenerals');
            $table->foreign('periodosrol_id')->references('id')->on('tm_periodosrols');
            $table->foreign('rubrosrol_id')->references('id')->on('tm_rubrosrols');

        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_prestamos_cabs');
    }
};
