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
        Schema::create('tm_periodosrols', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tiporol_id')->unsigned();
            $table->integer('mes');
            $table->string('remuneracion',1);
            $table->datetime('fechaini');
            $table->datetime('fechafin');
            $table->boolean('procesado');
            $table->boolean('aprobado');
            $table->boolean('cerrado');
            $table->string('usuario',50);
            $table->string('estado',1);
            $table->timestamps();

            $table->foreign('tiporol_id')->references('id')->on('tm_catalogogenerals');
            $table->unique(['tiporol_id', 'mes', 'remuneracion'],'tiporolid_mes_tiempo_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tm_periodosrols');
    }
};
