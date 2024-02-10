<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sender');
            $table->string('pick_up_loc');
            $table->string('no_sender');
            $table->string('nama_receiver');
            $table->string('destination_loc');
            $table->string('no_receiver');
            $table->string('berat_paket');
            $table->string('total');
            $table->string('nim')->reference('nim')->on('users');
            $table->string('id_mobil')->reference('id')->on('mobils');
            $table->string('id_travel_agent')->reference('id')->on('mobils');
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
        Schema::dropIfExists('delivery');
    }
}
