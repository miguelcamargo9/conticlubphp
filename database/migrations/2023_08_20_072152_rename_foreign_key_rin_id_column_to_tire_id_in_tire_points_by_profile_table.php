<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameForeignKeyRinIdColumnToTireIdInTirePointsByProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tire_points_by_profile', function (Blueprint $table) {
            $table->renameColumn('rin_id', 'tire_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tire_points_by_profile', function (Blueprint $table) {
            $table->renameColumn('tire_id', 'rin_id');
        });
    }
}
