<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointsMovementsDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points_movements_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('points')->nullable();
            $table->unsignedInteger('points_id');
            $table->unsignedInteger('points_movements_id');
            $table->timestamps();

            $table->foreign('points_id')->references('id')->on('points');
            $table->foreign('points_movements_id')->references('id')->on('points_movements');
        });

        Schema::table('points_movements_detail', function (Blueprint $table) {
            $table->index('points_id');
            $table->index('points_movements_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('points_movements_detail');
    }
}
