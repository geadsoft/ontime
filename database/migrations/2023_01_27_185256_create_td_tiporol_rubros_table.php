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
        Schema::create('td_tiporol_rubros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tiposrol_id')->unsigned();
            $table->unsignedBigInteger('rubrosrol_id')->unsigned();
            $table->string('tipo',1);
            $table->string('remuneracion',1);
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
        Schema::dropIfExists('td_tiporol_rubros');
    }
};
