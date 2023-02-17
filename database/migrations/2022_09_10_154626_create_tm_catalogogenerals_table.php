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
        Schema::create('tm_catalogogenerals', function (Blueprint $table) {
            $table->id();
            $table->integer('codigo');
            $table->string('descripcion',150);
            $table->integer('superior');
            $table->string('estado',1);
            $table->string('root',150);
            $table->string('usuario');
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
        Schema::dropIfExists('tm_catalogogenerals');
    }
};
