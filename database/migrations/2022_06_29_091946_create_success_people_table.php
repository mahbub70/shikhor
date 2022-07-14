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
        Schema::create('success_people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('batch_id')->nullable();
            $table->string('address')->nullable();
            $table->string('position')->nullable();
            $table->string('grade')->nullable();
            $table->string('message')->nullable();
            $table->text('desc')->nullable();
            $table->string('image')->default('default.jpg');
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
        Schema::dropIfExists('success_people');
    }
};
