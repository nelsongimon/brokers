<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInmueblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inmuebles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->integer('bolivares');
            $table->integer('dolares');
            $table->text('descripcion');
            $table->text('nota');
            $table->float('area_parcela');
            $table->float('area_construccion');
            $table->integer('cuartos');
            $table->integer('banos');
            $table->integer('estacionamientos');
            $table->enum('status',['yes','no'])->default('yes');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')->on('users');
            $table->integer('tipo_id')->unsigned();
            $table->foreign('tipo_id')
                ->references('id')->on('tipos')
                ->onDelete('cascade');
            $table->integer('negociacion_id')->unsigned();
            $table->foreign('negociacion_id')
                ->references('id')->on('negociaciones')
                ->onDelete('cascade');
            $table->integer('asesor_id')->unsigned();
            $table->foreign('asesor_id')
                ->references('id')->on('asesores')
                ->onDelete('cascade');
            $table->integer('estado_id')->unsigned();
            $table->foreign('estado_id')
                ->references('id')->on('estados')
                ->onDelete('cascade');
            $table->integer('ciudad_id')->unsigned();
            $table->foreign('ciudad_id')
                ->references('id')->on('ciudades')
                ->onDelete('cascade');
            $table->integer('sector_id')->unsigned();
            $table->foreign('sector_id')
                ->references('id')->on('sectores')
                ->onDelete('cascade');
            $table->string('slug')->nullable();
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
        Schema::drop('inmuebles');
    }
}
