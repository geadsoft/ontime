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
        Schema::create('tm_empresas', function (Blueprint $table) {
            $table->id();
            $table->string('razonsocial',150);
            $table->string('nombrecomercial',150);
            $table->string('ruc',150);
            $table->string('telefono',150);
            $table->string('provincia');
            $table->string('ciudad');
            $table->string('canton');
            $table->string('ubicacion',150);
            $table->string('representante',80);
            $table->string('identificacion',13);
            $table->string('website',50);
            $table->string('email',50);
            $table->string('imagen');
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
        Schema::dropIfExists('tm_empresas');
    }
};
