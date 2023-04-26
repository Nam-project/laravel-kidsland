<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->double('total'); //tong
            $table->enum('status',['ordered','delivered','canceled'])->default('ordered');
            $table->double('discount')->default(0);
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('ward_id')->nullable();
            $table->timestamps();
            $table->foreign('ward_id')->references('xaid')->on('devvn_xaphuongthitran');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
