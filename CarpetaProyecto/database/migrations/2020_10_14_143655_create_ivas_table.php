<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateIvasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ivas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('porcentaje');
            $table->dateTime('fechaCreacion');
        });
        DB::table("ivas")
        ->insert([
            "porcentaje" => "19",
            "fechaCreacion" => "2020-01-01 00:00:00",
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ivas');
    }
}
