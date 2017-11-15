<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensorNodeTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensor_node_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('type');

            $table->integer('sensor_node_id')->unsigned()->nullable();
            $table->foreign('sensor_node_id')->references('id')->on('sensor_nodes')->onDelete('cascade');

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
        Schema::dropIfExists('sensor_node_types');
    }
}
