<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensorNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensor_nodes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->json('coordinates');

            $table->integer('zone_id')->unsigned()->nullable();
            $table->foreign('zone_id')->references('id')->on('zones');

            $table->integer('account_id')->unsigned()->nullable();
            $table->foreign('account_id')->references('id')->on('accounts');

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
        Schema::dropIfExists('sensor_nodes');
    }
}
