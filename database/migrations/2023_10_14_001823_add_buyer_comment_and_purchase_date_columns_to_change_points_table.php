<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBuyerCommentAndPurchaseDateColumnsToChangePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('change_points', function (Blueprint $table) {
            $table->string('buyer_comment')->nullable();
            $table->date('purchase_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('change_points', function (Blueprint $table) {
            $table->dropColumn('buyer_comment');
            $table->dropColumn('purchase_date');
        });
    }
}
