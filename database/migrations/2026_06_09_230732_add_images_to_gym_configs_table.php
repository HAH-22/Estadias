<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('gym_configs', function (Blueprint $table) {
            $table->string('logo')->nullable()->after('sat_hours');
            $table->string('cover_photo')->nullable()->after('logo');
        });
    }

    public function down()
    {
        Schema::table('gym_configs', function (Blueprint $table) {
            $table->dropColumn(['logo', 'cover_photo']);
        });
    }
};
