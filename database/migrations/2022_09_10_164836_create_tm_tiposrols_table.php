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
        Schema::create('tm_tiposrols', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion',100);
            $table->unsignedBigInteger('tipoempleado_id')->nullable();
            $table->unsignedBigInteger('tipocontrato_id')->nullable();
            $table->string('tipoderol',1);
            $table->string('usuario',80);
            $table->string('estado',1);
            $table->timestamps();

            $table->foreign('tipoempleado_id')->references('id')->on('tm_catalogogenerals');
            $table->foreign('tipocontrato_id')->references('id')->on('tm_catalogogenerals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tm_tiposrols');
    }
};
