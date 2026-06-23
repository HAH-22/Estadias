<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('trainers', function (Blueprint $table) {
            if (!Schema::hasColumn('trainers', 'photo')) {
                $table->string('photo')->nullable()->after('bio');
            }
        });
    }

    public function down()
    {
        Schema::table('trainers', function (Blueprint $table) {
            $table->dropColumn('photo');
        });
    }
};
