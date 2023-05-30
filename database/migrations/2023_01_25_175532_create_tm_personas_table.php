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
        Schema::create('tm_personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombres',100);
            $table->string('apellidos',100);
            $table->string('tipo_nui',1);
            $table->string('nui',10);
            $table->string('direccion',150);
            $table->string('telefono',80);
            $table->string('instruccion',3);
            $table->integer('carga_familiar');
            $table->string('sexo',1);
            $table->string('estado_civil',1);
            $table->datetime('fecha_nace');
            $table->string('tipo_sangre',5);
            $table->unsignedBigInteger('entidadbancaria_id')->unsigned();
            $table->string('tipo_cuenta',3);
            $table->string('cuenta_banco',20);
            $table->string('estado',1);
            $table->timestamps();

            $table->foreign('entidadbancaria_id')->references('id')->on('tm_catalogogenerals');
            $table->unique(['nui'],'uq_nui');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tm_personas');
    }
};
