<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\GymConfigController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SocialNetworkController;
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\FaqController;
use Illuminate\Support\Facades\Route;

// Ruta pública principal (home)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Páginas públicas adicionales
Route::get('/informacion', [HomeController::class, 'info'])->name('info');
Route::get('/contacto', [HomeController::class, 'contact'])->name('contact');

// ==========================================
// CHATBOT (acceso público para todos)
// ==========================================
Route::get('/chatbot/ask', [ChatbotController::class, 'ask'])->name('chatbot.ask');

// Dashboard (protegido por auth y verificación)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Perfil de usuario (autenticado)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/mis-datos', [UserDataController::class, 'index'])->name('user-data.index');
    Route::put('/mis-datos', [UserDataController::class, 'update'])->name('user-data.update');
});

// Rutas de autenticación (Breeze)
require __DIR__.'/auth.php';

// --- Panel de Administración (solo admin) ---
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {

    // Gestión de precios
    Route::resource('prices', PriceController::class);

    // Gestión de slides
    Route::resource('slides', SlideController::class);
    
    // Gestión de planes
    Route::resource('plans', PlanController::class);
    
    // Gestión de entrenadores
    Route::resource('trainers', TrainerController::class);
    
    // Gestión de horarios
    Route::resource('schedules', ScheduleController::class);

    // Gestión de servicios
    Route::resource('services', ServiceController::class);

    // Gestión de redes sociales
    Route::resource('social-networks', SocialNetworkController::class);
    
    // Configuración del gimnasio
    Route::get('gym-config', [GymConfigController::class, 'edit'])->name('gym-config.edit');
    Route::put('gym-config', [GymConfigController::class, 'update'])->name('gym-config.update');
    
    // Gestión de usuarios (CRUD completo)
    Route::resource('users', UserController::class);

    // Gestión de Preguntas Frecuentes (FAQ)
    Route::resource('faqs', FaqController::class);
    
});