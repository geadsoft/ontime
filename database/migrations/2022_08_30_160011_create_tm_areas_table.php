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
        Schema::create('tm_areas', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion',100);
            $table->unsignedBigInteger('area_id')->nullable();
            $table->string('usuario',80);
            $table->string('estado',1);
            $table->timestamps();

            $table->foreign('area_id')->references('id')->on('tm_areas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tm_areas');
    }
};
