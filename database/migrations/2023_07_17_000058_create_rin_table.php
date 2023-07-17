<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150)->nullable();
            $table->unsignedInteger('design_id');
            $table->timestamps();

            $table->foreign('design_id')->references('id')->on('design');
        });

        Schema::table('rin', function (Blueprint $table) {
            $table->index('design_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rin');
    }
}
