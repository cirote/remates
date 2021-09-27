<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyRematadoresTable extends Migration
{
    public function up()
    {
        Schema::table('rematadores', function (Blueprint $table) 
        {
            $table->text('email')->nullable()->default(null)->after('nombre');
        });
    }

    public function down()
    {
        Schema::table('rematadores', function (Blueprint $table) 
        {
            $table->dropColumn('email');
        });
    }
}
