<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Price;
use App\Models\Schedule;
use App\Models\GymConfig;
use App\Models\Plan;
use App\Models\Service;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function ask(Request $request)
    {
        $query = $request->input('q', '');
        $lower = strtolower($query);

        // 1. Buscar en FAQs (respuestas personalizadas)
        $faq = Faq::where('is_active', true)
                  ->where(function ($q) use ($query) {
                      $q->where('question', 'LIKE', "%{$query}%")
                        ->orWhere('keyword', 'LIKE', "%{$query}%");
                  })
                  ->first();

        if ($faq) {
            return response()->json(['answer' => $faq->answer]);
        }

        // 2. Respuestas dinámicas desde tablas existentes

        // Precios
        if (str_contains($lower, 'precio') || str_contains($lower, 'costo') || str_contains($lower, 'pago')) {
            $prices = Price::where('is_active', true)->orderBy('order')->get();
            if ($prices->count()) {
                $answer = "💰 Nuestros precios son:\n";
                foreach ($prices as $price) {
                    $answer .= "• {$price->name}: $" . number_format($price->price, 2) . "\n";
                }
                return response()->json(['answer' => $answer]);
            }
        }

        // Horarios
        if (str_contains($lower, 'horario') || str_contains($lower, 'abierto') || str_contains($lower, 'cierre')) {
            $schedules = Schedule::all();
            $answer = "⏰ Nuestros horarios son:\n";
            foreach ($schedules as $s) {
                $status = $s->is_closed ? 'Cerrado' : ($s->open_time ? \Carbon\Carbon::parse($s->open_time)->format('H:i') . ' - ' . \Carbon\Carbon::parse($s->close_time)->format('H:i') . ' hrs' : '—');
                $answer .= "• {$s->day}: {$status}\n";
            }
            return response()->json(['answer' => $answer]);
        }

        // Ubicación (acepta múltiples sinónimos)
        $ubicacionKeywords = ['ubicacion', 'direccion', 'donde', 'localizacion', 'estamos'];
        $isUbicacion = false;
        foreach ($ubicacionKeywords as $keyword) {
            if (str_contains($lower, $keyword)) {
                $isUbicacion = true;
                break;
            }
        }
        if ($isUbicacion) {
            $config = GymConfig::first();
            $address = $config->address ?? 'Constitución 2625 col. centro, a un lado del estadio de béisbol';
            return response()->json(['answer' => "📍 Nuestra dirección es: {$address}"]);
        }

        // Contacto
        if (str_contains($lower, 'contacto') || str_contains($lower, 'telefono') || str_contains($lower, 'email') || str_contains($lower, 'correo')) {
            $config = GymConfig::first();
            $phone = $config->phone ?? '636-123-45-67';
            $email = $config->email ?? 'sitefitnessgym@gmail.com';
            return response()->json(['answer' => "📞 Contacto:\n• Teléfono: {$phone}\n• Correo: {$email}"]);
        }

        // Planes
        if (str_contains($lower, 'plan') || str_contains($lower, 'membresia')) {
            $plans = Plan::all();
            if ($plans->count()) {
                $answer = "📋 Planes de membresía:\n";
                foreach ($plans as $plan) {
                    $answer .= "• {$plan->name}: $" . number_format($plan->price, 2) . " / mes\n";
                }
                return response()->json(['answer' => $answer]);
            }
        }

        // Servicios
        if (str_contains($lower, 'servicio') || str_contains($lower, 'equipo') || str_contains($lower, 'instalacion')) {
            $services = Service::where('is_active', true)->get();
            if ($services->count()) {
                $answer = "🏋️ Nuestros servicios:\n";
                foreach ($services as $service) {
                    $answer .= "• {$service->title}: {$service->description}\n";
                }
                return response()->json(['answer' => $answer]);
            }
        }

        // Respuesta por defecto
        return response()->json([
            'answer' => '🤔 No encontré información sobre eso. Puedes contactarnos directamente.'
        ]);
    }
}