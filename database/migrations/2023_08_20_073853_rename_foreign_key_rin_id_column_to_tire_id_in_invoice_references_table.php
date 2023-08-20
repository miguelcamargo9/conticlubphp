<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameForeignKeyRinIdColumnToTireIdInInvoiceReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice_references', function (Blueprint $table) {
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
        Schema::table('invoice_references', function (Blueprint $table) {
            $table->renameColumn('tire_id', 'rin_id');
        });
    }
}
