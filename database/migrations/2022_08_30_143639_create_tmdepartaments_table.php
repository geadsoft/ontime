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
        Schema::create('tmdepartaments', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->integer('idarea');
            $table->integer('idpersonal');
            $table->integer('idcuenta');
            $table->integer('idccosto');
            $table->string('usuario');
            $table->string('estado');
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
        Schema::dropIfExists('tmdepartaments');
    }
};
