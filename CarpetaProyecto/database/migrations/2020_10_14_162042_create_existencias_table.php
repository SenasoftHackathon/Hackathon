<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('existencias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('idSucursal')->unsigned();
            $table->integer('idProducto')->unsigned();
            $table->integer('stockBodega');
            $table->integer('stockScursal');

            $table->foreign('idSucursal')->reference('id')->on('sucursales');
            $table->foreign('idProducto')->reference('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('existencias');
    }
}
