<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChangePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('change_points', function (Blueprint $table) {
            $table->increments('id');
            $table->string('state', 45)->nullable();
            $table->text('comment');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('users_id');
            $table->integer('points')->default(0);
            $table->unsignedInteger('approver_id')->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('product');
            $table->foreign('users_id')->references('id')->on('users');
        });

        Schema::table('change_points', function (Blueprint $table) {
            $table->index('product_id');
            $table->index('users_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('change_points');
    }
}
