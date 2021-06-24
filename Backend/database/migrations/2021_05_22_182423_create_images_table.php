<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('title');

            // foreign key
            // $table->bigInteger('event_id')->unsigned();
            // $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            // onDelete(cascade) bedeutet wenn buch gelöscht wird, wird auch das bild dazu gelöscht.
            // $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_id')->constrained()->onDelete('cascade');

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
        Schema::dropIfExists('images');
    }
}
