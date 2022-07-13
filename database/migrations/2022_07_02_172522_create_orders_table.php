<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->bigInteger('product_id');
            $table->string('customer_name');
            $table->string('customer_address');
            $table->string('customer_phone');
            $table->string('customer_qty');
            $table->string('transection_id');
            $table->integer('unit_price');
            $table->integer('total');
            $table->integer('advance');
            $table->integer('due')->nullable();
            $table->integer('delivery_status')->default(0);
            $table->integer('status')->default(1);
            $table->string('added_by');
            $table->timestamps();
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
};
