<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Hero Slides
        Schema::create('hero_slides', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('alt_text')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        // Hero Stats (the 4 stat boxes at bottom of hero)
        Schema::create('hero_stats', function (Blueprint $table) {
            $table->id();
            $table->string('counter_value'); // e.g. "48+", "★★★", "300"
            $table->string('counter_label'); // e.g. "Luxury Rooms"
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // About Pillars (Faith & Hospitality, Rwandan Warmth, etc.)
        Schema::create('about_pillars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Amenities / Offerings
        Schema::create('amenities', function (Blueprint $table) {
            $table->id();
            $table->string('icon'); // HTML entity or icon class
            $table->string('name');
            $table->text('description');
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        // Dining Items (restaurant list)
        Schema::create('dining_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('time_text'); // e.g. "06:30 – 22:30"
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Event Features (Grand Ballroom, Executive Boardroom, etc.)
        Schema::create('event_features', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Home Sections (stores per-section content: eyebrow, title, description, image, badge)
        Schema::create('home_sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_key')->unique(); // about, rooms, amenities, dining, events, testimonials, contact, hero
            $table->string('eyebrow')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('description_2')->nullable(); // second paragraph if needed
            $table->string('image')->nullable();
            $table->string('badge_value')->nullable();
            $table->string('badge_label')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_sections');
        Schema::dropIfExists('event_features');
        Schema::dropIfExists('dining_items');
        Schema::dropIfExists('amenities');
        Schema::dropIfExists('about_pillars');
        Schema::dropIfExists('hero_stats');
        Schema::dropIfExists('hero_slides');
    }
};
