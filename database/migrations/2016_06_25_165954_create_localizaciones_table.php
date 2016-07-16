<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localizaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->text('localizacion');
            $table->double('latitud', 15, 8);
            $table->double('longitud', 15, 8);
            $table->integer('zoom');
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
        Schema::drop('localizaciones');
    }
}
