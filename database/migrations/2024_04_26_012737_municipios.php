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
        Schema::create('municipios', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->bigIncrements('id_municipio');
            $table->string('municipio');
            $table->integer('estado');
            $table->bigInteger('id_departamento')->unsigned();
            $table->timestamps();

            $table->foreign('id_departamento')->references('id_departamento')->on('departamentos');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('municipios');
    }
};
