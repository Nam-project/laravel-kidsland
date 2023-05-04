<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToTableEvaluates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evaluates', function (Blueprint $table) {
            $table->bigInteger('detail_orders_id')->unsigned();
            $table->foreign('detail_orders_id')->references('id')->on('detail_orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evaluates', function (Blueprint $table) {
            //
        });
    }
}
