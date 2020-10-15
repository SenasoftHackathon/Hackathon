<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombreRol', 20);
            $table->string('descripcion', 255);
        });
        DB::table("roles")
            ->insert([
                    "nombreRol" => "Administrador",
                    "descripcion" => "Acceso total a la aplicación",
                ]
            );
        DB::table("roles")
            ->insert([
                "nombreRol" => "Bodega",
                "descripcion" => "Administración de bodega y unidades en stock",
            ]);
        DB::table("roles")
            ->insert([
                "nombreRol" => "Facturador",
                "descripcion" => "Administración de facturación",
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
