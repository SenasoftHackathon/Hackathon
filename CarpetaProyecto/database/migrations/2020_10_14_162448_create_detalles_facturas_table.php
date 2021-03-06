<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallesFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_facturas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idFactura')->unsigned();
            $table->bigInteger('idProducto')->unsigned();
            $table->integer('cantidad');
            $table->double('valorUnitario', 11, 2);

            $table->foreign('idFactura')->references('id')->on('facturas');
            $table->foreign('idProducto')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_facturas');
    }
}
