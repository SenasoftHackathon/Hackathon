<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idProveedor')->unsigned();
            $table->bigInteger('idIva')->unsigned();
            $table->string('nombre', 45);
            $table->double('precio', 11, 2);
            $table->boolean('estado')->default(1);

            $table->foreign('idProveedor')->references('id')->on('proveedores');
            $table->foreign('idIva')->references('id')->on('ivas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
