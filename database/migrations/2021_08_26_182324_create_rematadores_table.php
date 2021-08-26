<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRematadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rematadores', function (Blueprint $table) {
            $table->id();
            $table->integer('matricula');
            $table->text('apellido');
            $table->text('nombre');
            $table->text('web')->nullable();
            $table->text('telefono')->nullable();
            $table->json('domicilio')->nullable();
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
        Schema::dropIfExists('rematadores');
    }
}
