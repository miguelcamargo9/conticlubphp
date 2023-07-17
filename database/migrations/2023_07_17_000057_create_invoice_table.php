<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->date('sale_date')->nullable();
            $table->integer('number')->nullable();
            $table->string('price', 20)->nullable();
            $table->text('image');
            $table->unsignedInteger('users_id');
            $table->unsignedInteger('subsidiary_id');
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('subsidiary_id')->references('id')->on('subsidiary');
        });

        Schema::table('invoice', function (Blueprint $table) {
            $table->index('users_id');
            $table->unique(['number', 'subsidiary_id'], 'unique_invoice_subsidiary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice');
    }
}
