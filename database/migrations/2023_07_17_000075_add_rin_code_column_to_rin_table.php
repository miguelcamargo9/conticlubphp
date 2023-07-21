<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRinCodeColumnToRinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rin', function (Blueprint $table) {
            $table->string('rin_code')->nullable();
            $table->string('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rin', function (Blueprint $table) {
            $table->dropColumn('rin_code');
            $table->dropColumn('description');
        });
    }
}
