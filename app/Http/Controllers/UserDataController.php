<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDataController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $user = Auth::user();
        return view('user-data.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'weight' => 'nullable|numeric|min:0|max:500',
            'height' => 'nullable|numeric|min:0|max:300',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Actualizar peso y altura
        $user->weight = $request->input('weight');
        $user->height = $request->input('height');

        // Subir foto de perfil
        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo) {
                $this->imageService->delete($user->profile_photo);
            }
            $path = $this->imageService->upload($request->file('profile_photo'), 'profile-photos');
            $user->profile_photo = $path;
        }

        $user->save();

        return redirect()->route('user-data.index')->with('success', 'Datos actualizados correctamente.');
    }
}