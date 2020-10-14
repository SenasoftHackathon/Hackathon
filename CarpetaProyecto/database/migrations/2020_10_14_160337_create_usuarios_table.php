<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idSucursal')->unsigned();
            $table->bigInteger('idRol')->unsigned();
            $table->string('usuario', 45);
            $table->string('claveUsuario', 45);
            $table->boolean('estado')->default(1);
        
            $table->foreign('idSucursal')->reference('id')->on('sucursales');
            $table->foreign('idRol')->reference('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario');
    }
}
