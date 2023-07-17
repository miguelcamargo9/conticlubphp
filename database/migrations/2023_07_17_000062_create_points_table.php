<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('points')->nullable();
            $table->date('sum_date')->nullable();
            $table->string('state', 45)->nullable();
            $table->unsignedInteger('invoice_id');
            $table->timestamps();

            $table->foreign('invoice_id')->references('id')->on('invoice');
        });

        Schema::table('points', function (Blueprint $table) {
            $table->index('invoice_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('points');
    }
}
