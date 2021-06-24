<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->dateTime('appointment');
            $table->integer('people')->default('2');
            $table->integer('current_amount')->default('0');
            $table->timestamps();


            $table->bigInteger('location_id')->unsigned();

            $table->foreign('location_id')
                ->references('id')
                ->on('locations')
                ->onCascade('delete');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
