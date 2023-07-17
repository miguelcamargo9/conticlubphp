<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRinPointsByPerfilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rin_points_by_perfil', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('rin_id');
            $table->unsignedInteger('profiles_id');
            $table->integer('points_general')->nullable();
            $table->integer('points_uhp')->default(0);
            $table->integer('total_points');
            $table->timestamps();

            $table->foreign('rin_id')->references('id')->on('rin');
            $table->foreign('profiles_id')->references('id')->on('profiles');
        });

        Schema::table('rin_points_by_perfil', function (Blueprint $table) {
            $table->index('rin_id');
            $table->index('profiles_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rin_points_by_perfil');
    }
}
