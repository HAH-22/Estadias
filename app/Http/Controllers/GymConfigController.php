<?php

namespace App\Http\Controllers;

use App\Models\GymConfig;
use App\Services\ImageService;
use Illuminate\Http\Request;

class GymConfigController extends Controller
{

    public function edit()
    {
        $config = GymConfig::first();
        return view('admin.gym-config.edit', compact('config'));
    }

    public function update(Request $request, ImageService $imageService) // ← inyecta el servicio
    {
        $config = GymConfig::first();

        $request->validate([
            'address' => 'nullable|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:255',
        ]);

        $data = $request->except(['logo', 'cover_photo', '_token', '_method']);

        // Subir logo
        if ($request->hasFile('logo')) {
            if ($config && $config->logo) {
                $imageService->delete($config->logo);
            }
            $data['logo'] = $imageService->upload($request->file('logo'), 'gym');
        }

        // Subir foto de portada
        if ($request->hasFile('cover_photo')) {
            if ($config && $config->cover_photo) {
                $imageService->delete($config->cover_photo);
            }
            $data['cover_photo'] = $imageService->upload($request->file('cover_photo'), 'gym');
        }

        if (!$config) {
            GymConfig::create($data);
        } else {
            $config->update($data);
        }

        return redirect()->route('admin.gym-config.edit')
            ->with('success', 'Configuración actualizada correctamente.');
    }
}