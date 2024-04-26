<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_creacion');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('cedula')->unique();
            $table->bigInteger('departamento')->unsigned();
            $table->bigInteger('ciudad')->unsigned();
            $table->string('celular');
            $table->string('correo');
            $table->boolean('autorizo');
            $table->timestamps();

            $table->foreign('departamento')->references('id_departamento')->on('departamentos');
            $table->foreign('ciudad')->references('id_municipio')->on('municipios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};
