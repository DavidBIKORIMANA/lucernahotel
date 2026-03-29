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
        // Add payment-related columns to bookings
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('payment_phone')->nullable()->after('payment_method');
            $table->string('payment_bank_name')->nullable()->after('payment_phone');
            $table->string('payment_bank_ref')->nullable()->after('payment_bank_name');
            $table->string('payment_proof')->nullable()->after('payment_bank_ref');
            $table->text('admin_notes')->nullable()->after('cancellation_reason');
            $table->timestamp('confirmed_at')->nullable()->after('checked_out_at');
            $table->unsignedBigInteger('confirmed_by')->nullable()->after('confirmed_at');
            $table->timestamp('denied_at')->nullable()->after('confirmed_by');
            $table->text('denial_reason')->nullable()->after('denied_at');
        });

        // Enhance payment_transactions for multi-method support
        Schema::table('payment_transactions', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('transaction_id');
            $table->string('bank_name')->nullable()->after('phone');
            $table->string('bank_ref')->nullable()->after('bank_name');
            $table->string('proof_file')->nullable()->after('bank_ref');
            $table->text('notes')->nullable()->after('gateway_response');
            $table->unsignedBigInteger('verified_by')->nullable()->after('notes');
            $table->timestamp('verified_at')->nullable()->after('verified_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'payment_phone', 'payment_bank_name', 'payment_bank_ref',
                'payment_proof', 'admin_notes', 'confirmed_at', 'confirmed_by',
                'denied_at', 'denial_reason',
            ]);
        });

        Schema::table('payment_transactions', function (Blueprint $table) {
            $table->dropColumn([
                'phone', 'bank_name', 'bank_ref', 'proof_file',
                'notes', 'verified_by', 'verified_at',
            ]);
        });
    }
};
