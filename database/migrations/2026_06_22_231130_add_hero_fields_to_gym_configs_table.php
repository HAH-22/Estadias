<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('gym_configs', function (Blueprint $table) {
            $table->string('hero_title')->default('Entrena duro, vive fuerte')->after('id');
            $table->string('hero_subtitle')->default('Encuentra las mejores instalaciones aquí, ¡ENTRENA CON NOSOTROS!')->after('hero_title');
        });
    }

    public function down()
    {
        Schema::table('gym_configs', function (Blueprint $table) {
            $table->dropColumn(['hero_title', 'hero_subtitle']);
        });
    }
};
