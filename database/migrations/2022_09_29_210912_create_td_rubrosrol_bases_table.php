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
        Schema::create('td_rubrosrol_bases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rubrosrol_id')->unsigned();
            $table->unsignedBigInteger('baserubrorol_id')->unsigned();
            $table->double('importe',14,6);
            $table->double('constante',14,6);
            $table->string('usuario',50);
            $table->timestamps();

            $table->foreign('rubrosrol_id')->references('id')->on('tm_rubrosrols');
            $table->foreign('baserubrorol_id')->references('id')->on('tm_rubrosrols');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('td_rubrosrol_bases');
    }
};
