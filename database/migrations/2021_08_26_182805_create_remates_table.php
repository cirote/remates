<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRematesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remates', function (Blueprint $table) {
            $table->id();
            $table->integer('aviso');
            $table->integer('año');
            $table->date('remate_fecha');
            $table->time('remate_hora');
            $table->date('publicacion_fecha');
            $table->text('bien');
            $table->text('condiciones');
            $table->foreignId('lugar_id')->constrained('lugares')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('localidad_id')->constrained('localidades')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('rematador_id')->constrained('rematadores')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('interesante')->nullable()->default(null);
            $table->decimal('precio')->nullable()->default(null);
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
        Schema::table('remates', function (Blueprint $table) 
        {
            $table->dropForeign('remates_lugar_id_foreign');
            $table->dropForeign('remates_localidad_id_foreign');
            $table->dropForeign('remates_rematador_id_foreign');
        });

        Schema::dropIfExists('remates');
    }
}
