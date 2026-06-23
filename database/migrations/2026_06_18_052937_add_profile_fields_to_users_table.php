<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'weight')) {
                $table->decimal('weight', 5, 2)->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'height')) {
                $table->decimal('height', 5, 2)->nullable()->after('weight');
            }
            if (!Schema::hasColumn('users', 'profile_photo')) {
                $table->string('profile_photo')->nullable()->after('height');
            }
            if (!Schema::hasColumn('users', 'plan_id')) {
                $table->foreignId('plan_id')->nullable()->after('profile_photo')->constrained('plans')->nullOnDelete();
            }
            if (!Schema::hasColumn('users', 'membership_expires_at')) {
                $table->date('membership_expires_at')->nullable()->after('plan_id');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['plan_id']);
            $table->dropColumn(['weight', 'height', 'profile_photo', 'plan_id', 'membership_expires_at']);
        });
    }
};