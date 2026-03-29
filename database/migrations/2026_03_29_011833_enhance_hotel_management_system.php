<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. ENHANCE ROOM_TYPES
        Schema::table('room_types', function (Blueprint $table) {
            if (!Schema::hasColumn('room_types', 'slug')) {
                $table->string('slug')->nullable()->after('name');
            }
            if (!Schema::hasColumn('room_types', 'description')) {
                $table->text('description')->nullable()->after('slug');
            }
            if (!Schema::hasColumn('room_types', 'sort_order')) {
                $table->integer('sort_order')->default(0)->after('status');
            }
        });

        // 2. ENHANCE ROOMS
        Schema::table('rooms', function (Blueprint $table) {
            if (!Schema::hasColumn('rooms', 'name')) {
                $table->string('name')->nullable()->after('roomtype_id');
            }
            if (!Schema::hasColumn('rooms', 'slug')) {
                $table->string('slug')->nullable()->after('name');
            }
            if (!Schema::hasColumn('rooms', 'floor')) {
                $table->string('floor')->nullable()->after('bed_style');
            }
            if (!Schema::hasColumn('rooms', 'amenities')) {
                $table->json('amenities')->nullable()->after('floor');
            }
            if (!Schema::hasColumn('rooms', 'featured')) {
                $table->boolean('featured')->default(false)->after('status');
            }
            $table->index(['status', 'roomtype_id'], 'rooms_status_type_idx');
        });

        // 3. ENHANCE ROOM_NUMBERS
        Schema::table('room_numbers', function (Blueprint $table) {
            if (!Schema::hasColumn('room_numbers', 'floor')) {
                $table->string('floor')->nullable()->after('room_no');
            }
            if (!Schema::hasColumn('room_numbers', 'notes')) {
                $table->text('notes')->nullable()->after('status');
            }
        });

        // 4. ENHANCE BOOKINGS
        Schema::table('bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('bookings', 'nid')) {
                $table->string('nid')->nullable()->after('status');
            }
            if (!Schema::hasColumn('bookings', 'adults')) {
                $table->unsignedTinyInteger('adults')->default(1)->after('check_out');
            }
            if (!Schema::hasColumn('bookings', 'children')) {
                $table->unsignedTinyInteger('children')->default(0)->after('adults');
            }
            if (!Schema::hasColumn('bookings', 'currency')) {
                $table->string('currency', 3)->default('USD')->after('total_price');
            }
            if (!Schema::hasColumn('bookings', 'cancelled_at')) {
                $table->timestamp('cancelled_at')->nullable()->after('status');
            }
            if (!Schema::hasColumn('bookings', 'cancellation_reason')) {
                $table->text('cancellation_reason')->nullable()->after('cancelled_at');
            }
            if (!Schema::hasColumn('bookings', 'special_requests')) {
                $table->text('special_requests')->nullable()->after('address');
            }
            if (!Schema::hasColumn('bookings', 'checked_in_at')) {
                $table->timestamp('checked_in_at')->nullable()->after('nid');
            }
            if (!Schema::hasColumn('bookings', 'checked_out_at')) {
                $table->timestamp('checked_out_at')->nullable()->after('checked_in_at');
            }
            if (!Schema::hasColumn('bookings', 'source')) {
                $table->string('source')->default('website')->after('code');
            }
            $table->index(['status', 'payment_status'], 'bookings_status_payment_idx');
            $table->index(['check_in', 'check_out'], 'bookings_dates_idx');
            $table->index('user_id', 'bookings_user_idx');
            $table->index('code', 'bookings_code_idx');
        });

        // 5. ENHANCE ROOM_BOOKED_DATES
        Schema::table('room_booked_dates', function (Blueprint $table) {
            $table->index(['room_id', 'book_date'], 'rbd_room_date_idx');
            if (!Schema::hasColumn('room_booked_dates', 'room_number_id')) {
                $table->unsignedBigInteger('room_number_id')->nullable()->after('room_id');
            }
        });

        // 6. ENHANCE BOOKING_ROOM_LISTS
        Schema::table('booking_room_lists', function (Blueprint $table) {
            $table->index(['booking_id', 'room_id'], 'brl_booking_room_idx');
        });

        // 7. REVIEWS TABLE
        if (!Schema::hasTable('reviews')) {
            Schema::create('reviews', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('booking_id');
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('room_id')->nullable();
                $table->unsignedTinyInteger('rating')->default(5);
                $table->string('title')->nullable();
                $table->text('comment');
                $table->boolean('is_approved')->default(false);
                $table->timestamp('approved_at')->nullable();
                $table->timestamps();
                $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('room_id')->references('id')->on('rooms')->onDelete('set null');
                $table->index(['is_approved', 'rating'], 'reviews_approved_rating_idx');
            });
        }

        // 8. RATE SEASONS TABLE (Dynamic Pricing)
        if (!Schema::hasTable('rate_seasons')) {
            Schema::create('rate_seasons', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->date('start_date');
                $table->date('end_date');
                $table->decimal('price_multiplier', 4, 2)->default(1.00);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
                $table->index(['start_date', 'end_date', 'is_active'], 'rs_dates_active_idx');
            });
        }

        // 9. ROOM RATE OVERRIDES
        if (!Schema::hasTable('room_rate_overrides')) {
            Schema::create('room_rate_overrides', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('room_id');
                $table->unsignedBigInteger('rate_season_id');
                $table->decimal('price', 10, 2);
                $table->timestamps();
                $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
                $table->foreign('rate_season_id')->references('id')->on('rate_seasons')->onDelete('cascade');
                $table->unique(['room_id', 'rate_season_id'], 'rro_room_season_unique');
            });
        }

        // 10. PAYMENT TRANSACTIONS TABLE
        if (!Schema::hasTable('payment_transactions')) {
            Schema::create('payment_transactions', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('booking_id');
                $table->string('method');
                $table->string('transaction_id')->nullable();
                $table->decimal('amount', 10, 2);
                $table->string('currency', 3)->default('USD');
                $table->string('status')->default('pending');
                $table->json('gateway_response')->nullable();
                $table->timestamps();
                $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
                $table->index(['booking_id', 'status'], 'pt_booking_status_idx');
            });
        }

        // 11. BOOKING EXTRAS TABLE
        if (!Schema::hasTable('booking_extras')) {
            Schema::create('booking_extras', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('booking_id');
                $table->string('name');
                $table->decimal('price', 10, 2)->default(0);
                $table->unsignedInteger('quantity')->default(1);
                $table->timestamps();
                $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            });
        }

        // 12. ACTIVITY LOG TABLE
        if (!Schema::hasTable('activity_logs')) {
            Schema::create('activity_logs', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('action');
                $table->string('model_type')->nullable();
                $table->unsignedBigInteger('model_id')->nullable();
                $table->json('changes')->nullable();
                $table->string('ip_address', 45)->nullable();
                $table->timestamps();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
                $table->index(['model_type', 'model_id'], 'al_model_idx');
                $table->index('created_at', 'al_created_idx');
            });
        }

        // 13. ENHANCE USERS TABLE
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'language')) {
                $table->string('language', 5)->default('en')->after('status');
            }
            if (!Schema::hasColumn('users', 'currency_preference')) {
                $table->string('currency_preference', 3)->default('USD')->after('language');
            }
            if (!Schema::hasColumn('users', 'nationality')) {
                $table->string('nationality')->nullable()->after('address');
            }
            if (!Schema::hasColumn('users', 'id_type')) {
                $table->string('id_type')->nullable()->after('nationality');
            }
            if (!Schema::hasColumn('users', 'id_number')) {
                $table->string('id_number')->nullable()->after('id_type');
            }
        });

        // 14. ENHANCE FACILITIES
        Schema::table('facilities', function (Blueprint $table) {
            if (!Schema::hasColumn('facilities', 'icon')) {
                $table->string('icon')->nullable()->after('facility_name');
            }
        });

        // 15. ENHANCE SITE_SETTINGS
        Schema::table('site_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('site_settings', 'instagram')) {
                $table->string('instagram')->nullable()->after('twitter');
            }
            if (!Schema::hasColumn('site_settings', 'whatsapp')) {
                $table->string('whatsapp')->nullable()->after('instagram');
            }
            if (!Schema::hasColumn('site_settings', 'google_analytics_id')) {
                $table->string('google_analytics_id')->nullable()->after('copyright');
            }
            if (!Schema::hasColumn('site_settings', 'google_maps_embed')) {
                $table->text('google_maps_embed')->nullable()->after('google_analytics_id');
            }
            if (!Schema::hasColumn('site_settings', 'default_currency')) {
                $table->string('default_currency', 3)->default('USD')->after('google_maps_embed');
            }
            if (!Schema::hasColumn('site_settings', 'checkin_time')) {
                $table->string('checkin_time')->default('14:00')->after('default_currency');
            }
            if (!Schema::hasColumn('site_settings', 'checkout_time')) {
                $table->string('checkout_time')->default('11:00')->after('checkin_time');
            }
            if (!Schema::hasColumn('site_settings', 'cancellation_policy')) {
                $table->text('cancellation_policy')->nullable()->after('checkout_time');
            }
            if (!Schema::hasColumn('site_settings', 'terms_conditions')) {
                $table->text('terms_conditions')->nullable()->after('cancellation_policy');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('booking_extras');
        Schema::dropIfExists('payment_transactions');
        Schema::dropIfExists('room_rate_overrides');
        Schema::dropIfExists('rate_seasons');
        Schema::dropIfExists('reviews');

        Schema::table('rooms', function (Blueprint $table) {
            $table->dropIndex('rooms_status_type_idx');
            $table->dropColumn(['name', 'slug', 'floor', 'amenities', 'featured']);
        });
        Schema::table('room_types', function (Blueprint $table) {
            $table->dropColumn(['slug', 'description', 'sort_order']);
        });
        Schema::table('room_numbers', function (Blueprint $table) {
            $table->dropColumn(['floor', 'notes']);
        });
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropIndex('bookings_status_payment_idx');
            $table->dropIndex('bookings_dates_idx');
            $table->dropIndex('bookings_user_idx');
            $table->dropIndex('bookings_code_idx');
            $table->dropColumn([
                'adults', 'children', 'currency', 'cancelled_at',
                'cancellation_reason', 'special_requests', 'checked_in_at',
                'checked_out_at', 'source'
            ]);
        });
        Schema::table('room_booked_dates', function (Blueprint $table) {
            $table->dropIndex('rbd_room_date_idx');
            $table->dropColumn('room_number_id');
        });
        Schema::table('booking_room_lists', function (Blueprint $table) {
            $table->dropIndex('brl_booking_room_idx');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['language', 'currency_preference', 'nationality', 'id_type', 'id_number']);
        });
        Schema::table('facilities', function (Blueprint $table) {
            $table->dropColumn('icon');
        });
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'instagram', 'whatsapp', 'google_analytics_id', 'google_maps_embed',
                'default_currency', 'checkin_time', 'checkout_time',
                'cancellation_policy', 'terms_conditions'
            ]);
        });
    }
};
