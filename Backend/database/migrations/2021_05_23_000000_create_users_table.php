<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('isAdmin')->default('0');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('svnr')->unique();
            $table->boolean('isVaccinated')->default('0');
            $table->boolean('vaccinationAllowed')->default('1');
            $table->rememberToken();
            $table->timestamps();

            $table->bigInteger('event_id')->unsigned()->nullable();

            $table->foreign('event_id')
                ->references('id')
                ->on('events')
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
        Schema::dropIfExists('users');
    }
}
