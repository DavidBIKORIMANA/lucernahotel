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
        // Ensure all existing admin users have the Spatie 'admin' role assigned
        $adminUsers = \DB::table('users')->where('role', 'admin')->pluck('id');
        $adminRole = \DB::table('roles')->where('name', 'admin')->where('guard_name', 'web')->first();

        if ($adminRole) {
            foreach ($adminUsers as $userId) {
                $exists = \DB::table('model_has_roles')
                    ->where('role_id', $adminRole->id)
                    ->where('model_id', $userId)
                    ->where('model_type', 'App\\Models\\User')
                    ->exists();

                if (!$exists) {
                    \DB::table('model_has_roles')->insert([
                        'role_id' => $adminRole->id,
                        'model_id' => $userId,
                        'model_type' => 'App\\Models\\User',
                    ]);
                }
            }
        }

        // Drop the redundant role enum column from users table
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'user'])->default('user')->after('address');
        });

        // Restore role column values from Spatie roles
        $adminRole = \DB::table('roles')->where('name', 'admin')->where('guard_name', 'web')->first();
        if ($adminRole) {
            $adminUserIds = \DB::table('model_has_roles')
                ->where('role_id', $adminRole->id)
                ->where('model_type', 'App\\Models\\User')
                ->pluck('model_id');

            \DB::table('users')->whereIn('id', $adminUserIds)->update(['role' => 'admin']);
        }
    }
};
