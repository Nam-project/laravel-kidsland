<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_receipts', function (Blueprint $table) {
            $table->id();
            $table->decimal('price'); //don gia
            $table->unsignedInteger('quantity');
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->bigInteger('warehouse_id')->unsigned()->nullable();
            $table->bigInteger('receipt_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('warehouse_id')->references('id')->on('ware_houses')->onDelete('cascade');
            $table->foreign('receipt_id')->references('id')->on('receipts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_receipts');
    }
}
