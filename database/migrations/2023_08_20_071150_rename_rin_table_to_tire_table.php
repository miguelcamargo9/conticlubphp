<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameRinTableToTireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('rin', 'tire');
        Schema::rename('rin_points_by_perfil', 'tire_points_by_profile');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('tire', 'rin');
        Schema::rename('tire_points_by_profile', 'rin_points_by_perfil');
    }
}
