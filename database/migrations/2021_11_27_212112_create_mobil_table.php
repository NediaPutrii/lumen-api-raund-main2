<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobils', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mobil');
            $table->integer('kapasitas');
            $table->string('status');
            $table->string('jam_departure');
            $table->integer('delivery_fee');
            $table->integer('travel_fee');
            $table->string('id_travel_agent');


            $table->foreign('id_travel_agent')->references('id_travel_agent')->on('travel_agents')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('mobil');
    }
}
