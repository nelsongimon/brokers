<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetricasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metricas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->string('imagen');
            $table->integer('visitas');
            $table->integer('inmueble_id')->unsigned();
            $table->foreign('inmueble_id')
                ->references('id')->on('inmuebles')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('metricas');
    }
}
