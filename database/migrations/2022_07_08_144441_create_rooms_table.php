<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('title')->require();
            $table->string('size')->require();
            $table->integer('capacity')->require();
            $table->string('bed_types')->require();
            $table->integer('bed_count')->require();
            $table->integer('room_number')->unique();
            $table->string('category_id')->require();
            $table->longText('description')->require();
            $table->longText('facilities')->require();
            $table->float('price')->require();
            $table->enum('availability',['reserved','free'])->default('free');
            $table->enum('status',['active','inactive'])->default('active');
            $table->string('room_image')->require();
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
        Schema::dropIfExists('rooms');
    }
};
