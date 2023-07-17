<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150)->nullable();
            $table->text('image');
            $table->integer('points')->nullable();
            $table->string('state', 45)->nullable();
            $table->unsignedInteger('product_categories_id');
            $table->string('points_value', 20)->nullable();
            $table->string('estimated_value', 20)->nullable();
            $table->timestamps();

            $table->foreign('product_categories_id')->references('id')->on('product_categories');
        });

        Schema::table('product', function (Blueprint $table) {
            $table->index('product_categories_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
