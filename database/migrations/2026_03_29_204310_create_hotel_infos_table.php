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
        Schema::create('hotel_infos', function (Blueprint $table) {
            $table->id();
            $table->string('group');          // Policies, Services, Accessibility & Pet Policy
            $table->string('title');           // e.g. "Check-in: 2:00 PM", "Front Desk"
            $table->string('detail')->nullable(); // e.g. "Staffed 24/7"
            $table->string('icon')->nullable();   // SVG icon name or class
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_infos');
    }
};
