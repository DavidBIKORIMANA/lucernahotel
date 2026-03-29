<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('room_numbers', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('rooms_id');
            $table->unsignedBigInteger('room_type_id');
            $table->string('room_no')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->foreign('rooms_id')->references('id')->on('rooms')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('room_type_id')->references('id')->on('room_types')->onDelete('restrict')->onUpdate('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_numbers');
    }
};
