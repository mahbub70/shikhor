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
        Schema::create('mcqs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('class_id');
            $table->integer('year')->nullable();
            $table->string('question');
            $table->string('option_one')->nullable();
            $table->string('option_two')->nullable();
            $table->string('option_three')->nullable();
            $table->string('option_four')->nullable();
            $table->string('currect_ans')->nullable();
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
        Schema::dropIfExists('mcqs');
    }
};
