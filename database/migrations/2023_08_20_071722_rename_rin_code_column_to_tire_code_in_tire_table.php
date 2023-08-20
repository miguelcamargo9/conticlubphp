<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameRinCodeColumnToTireCodeInTireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tire', function (Blueprint $table) {
            $table->renameColumn('rin_code', 'tire_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tire', function (Blueprint $table) {
            $table->renameColumn('tire_code', 'rin_code');
        });
    }
}
