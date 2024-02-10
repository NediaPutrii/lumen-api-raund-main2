<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel', function (Blueprint $table) {
            $table->id();
            $table->string('current_loc');
            $table->string('destination');
            $table->dateTime('departure');
            $table->dateTime('arrive');
            $table->integer('jumlah_passanger');
            $table->integer('total');
            $table->string('nim')->reference('nim')->on('users');
            $table->string('id_mobil')->reference('id')->on('mobils');
            $table->string('id_travel_agent')->references('id_travel_agent')->on('travel_agents')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('travel');
    }
}
