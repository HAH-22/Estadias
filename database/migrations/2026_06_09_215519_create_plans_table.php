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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Individual, Pareja, Grupo
            $table->decimal('price', 8, 2); // precio mensual
            $table->decimal('inscription_fee', 8, 2)->nullable(); // inscripción
            $table->text('description')->nullable();
            $table->text('features')->nullable(); // características (acceso ilimitado, etc.)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
