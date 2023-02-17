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
        Schema::create('tm_contratos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('persona_id')->unsigned();
            $table->string('codigo_sectorial',20);
            $table->datetime('fecha');
            $table->unsignedBigInteger('tipoempleado_id')->unsigned();
            $table->unsignedBigInteger('tipocontrato_id')->unsigned();
            $table->unsignedBigInteger('area_id')->unsigned();
            $table->unsignedBigInteger('departamento_id')->unsigned();
            $table->unsignedBigInteger('cargo_id')->unsigned();
            $table->datetime('fecha_ingreso');
            $table->datetime('fecha_salida')->nullable();
            $table->string('fondo_reserva',2);
            $table->double('anticipo',14,2);
            $table->double('sueldo',14,2);
            $table->string('tipo_pago',3);
            $table->string('usuario',50);
            $table->string('estado',1);
            $table->timestamps();

            $table->foreign('persona_id')->references('id')->on('tm_personas');
            $table->foreign('tipoempleado_id')->references('id')->on('tm_catalogogenerals');
            $table->foreign('tipocontrato_id')->references('id')->on('tm_catalogogenerals');
            $table->foreign('area_id')->references('id')->on('tm_areas');
            $table->foreign('departamento_id')->references('id')->on('tm_areas');
            $table->foreign('cargo_id')->references('id')->on('tm_cargocias');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tm_contratos');
    }
};
