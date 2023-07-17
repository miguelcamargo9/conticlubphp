<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles_menu', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('profiles_id');
            $table->unsignedInteger('menu_id');
            $table->timestamps();

            $table->foreign('profiles_id')->references('id')->on('profiles');
            $table->foreign('menu_id')->references('id')->on('menus');
        });

        Schema::table('profiles_menu', function (Blueprint $table) {
            $table->index('profiles_id');
            $table->index('menu_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles_menu');
    }
}
