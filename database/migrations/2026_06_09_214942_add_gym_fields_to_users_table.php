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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'weight')) {
                $table->decimal('weight', 5, 2)->nullable();
            }
            if (!Schema::hasColumn('users', 'height')) {
                $table->decimal('height', 5, 2)->nullable();
            }
            if (!Schema::hasColumn('users', 'profile_photo')) {
                $table->string('profile_photo')->nullable();
            }
            if (!Schema::hasColumn('users', 'plan_id')) {
                $table->foreignId('plan_id')->nullable()->constrained('plans');
            }
            if (!Schema::hasColumn('users', 'membership_expires_at')) {
                $table->date('membership_expires_at')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['weight', 'height', 'profile_photo', 'plan_id', 'membership_expires_at']);
        });
    }
};
