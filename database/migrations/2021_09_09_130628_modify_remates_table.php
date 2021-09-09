<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyRematesTable extends Migration
{
    public function up()
    {
        Schema::table('remates', function (Blueprint $table) 
        {
            $table->boolean('descartado')->default(false)->after('interesante');
            $table->longText('observaciones')->nullable()->default(null)->after('precio');
        });
    }

    public function down()
    {
        Schema::table('remates', function (Blueprint $table) 
        {
            $table->dropColumn('descartado');
            $table->dropColumn('observaciones');
        });
    }
}
