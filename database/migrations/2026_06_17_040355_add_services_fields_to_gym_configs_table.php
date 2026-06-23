<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('gym_configs', function (Blueprint $table) {
            $table->string('pesas_title')->default('Pesas')->after('cover_photo');
            $table->text('pesas_description')->nullable()->after('pesas_title');
            $table->string('cardio_title')->default('Cardio')->after('pesas_description');
            $table->text('cardio_description')->nullable()->after('cardio_title');
            $table->string('maquinas_title')->default('Máquinas')->after('cardio_description');
            $table->text('maquinas_description')->nullable()->after('maquinas_title');
        });
    }

    public function down()
    {
        Schema::table('gym_configs', function (Blueprint $table) {
            $table->dropColumn([
                'pesas_title',
                'pesas_description',
                'cardio_title',
                'cardio_description',
                'maquinas_title',
                'maquinas_description'
            ]);
        });
    }
}; 
