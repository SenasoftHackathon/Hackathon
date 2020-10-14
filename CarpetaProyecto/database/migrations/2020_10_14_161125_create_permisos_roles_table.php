<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermisosRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permiso_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idPermiso')->unsigned();
            $table->bigInteger('idRol')->unsigned();

            $table->foreign('idPermiso')->references('id')->on('permisos');
            $table->foreign('idRol')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permiso_roles');
    }
}
