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
        Schema::create('tm_cargocias', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion',150);
            $table->unsignedBigInteger('cargo_id')->nullable();
            $table->string('estado',1);
            $table->string('usuario');
            $table->timestamps();

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
        Schema::dropIfExists('tm_cargocias');
    }
};
