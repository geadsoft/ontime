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
        Schema::create('tm_variables', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion',50);
            $table->string('tipo',1);
            $table->string('referencia',200);
            $table->string('campo',60);
            $table->string('formula',100);
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
        Schema::dropIfExists('tm_variables');
    }
};
