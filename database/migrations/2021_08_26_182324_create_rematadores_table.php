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
            $table->integer('matricula')->unique();
            $table->text('apellido');
            $table->text('nombre');
            $table->text('web')->nullable()->default(null);
            $table->text('telefono')->nullable()->default(null);
            $table->json('domicilio')->nullable()->default(null);
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
