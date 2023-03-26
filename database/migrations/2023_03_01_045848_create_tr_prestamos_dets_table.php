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
        Schema::create('tr_prestamos_dets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prestamo_id')->unsigned();
            $table->integer('cuota');
            $table->datetime('fecha');
            $table->double('valor',14,2);
            $table->string('estado',1);
            $table->string('usuario',50);
            $table->timestamps();

            $table->foreign('prestamo_id')->references('id')->on('tr_prestamos_cabs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_prestamos_dets');
    }
};
