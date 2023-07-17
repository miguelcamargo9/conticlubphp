<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceReferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_references', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amount')->nullable();
            $table->unsignedInteger('invoice_id');
            $table->unsignedInteger('rin_id');
            $table->string('points', 8)->default('');
            $table->timestamps();

            $table->foreign('invoice_id')->references('id')->on('invoice');
            $table->foreign('rin_id')->references('id')->on('rin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_references');
    }
}
