<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name', 150)->nullable();
            $table->string('password')->nullable();
            $table->string('email', 150)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('identification_number', 15)->nullable();
            $table->string('identification_type', 3)->nullable();
            $table->tinyInteger('state')->nullable();
            $table->integer('points')->nullable();
            $table->unsignedInteger('profiles_id')->nullable();
            $table->unsignedInteger('subsidiary_id');
            $table->timestamps();

            $table->foreign('profiles_id')->references('id')->on('profiles');
            $table->foreign('subsidiary_id')->references('id')->on('subsidiary');
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
