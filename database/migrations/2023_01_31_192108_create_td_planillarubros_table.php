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
        Schema::create('td_planillarubros', function (Blueprint $table) {
            $table->id();
            $table->datetime('fecha');
            $table->string('tipo',1);
            $table->unsignedBigInteger('tiposrol_id')->unsigned();
            $table->unsignedBigInteger('periodosrol_id')->unsigned();
            $table->unsignedBigInteger('persona_id')->unsigned();
            $table->unsignedBigInteger('rubrosrol_id')->unsigned();
            $table->double('valor',14,2);
            $table->string('usuario',50);
            $table->string('estado',1);
            $table->timestamps();

            $table->foreign('tiposrol_id')->references('id')->on('tm_tiposrols');
            $table->foreign('periodosrol_id')->references('id')->on('tm_periodosrols');
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
        Schema::dropIfExists('td_planillarubros');
    }
};
