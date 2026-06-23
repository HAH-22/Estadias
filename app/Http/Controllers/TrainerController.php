<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use App\Services\ImageService;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $trainers = Trainer::all();
        return view('admin.trainers.index', compact('trainers'));
    }

    public function create()
    {
        return view('admin.trainers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('photo');
        if ($request->hasFile('photo')) {
            $data['photo'] = $this->imageService->upload($request->file('photo'), 'trainers');
        }

        Trainer::create($data);
        return redirect()->route('admin.trainers.index')->with('success', 'Entrenador creado correctamente.');
    }

    public function edit(Trainer $trainer)
    {
        return view('admin.trainers.edit', compact('trainer'));
    }

    public function update(Request $request, Trainer $trainer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('photo');
        if ($request->hasFile('photo')) {
            $data['photo'] = $this->imageService->replace($request->file('photo'), $trainer->photo, 'trainers');
        }

        $trainer->update($data);
        return redirect()->route('admin.trainers.index')->with('success', 'Entrenador actualizado.');
    }

    public function destroy(Trainer $trainer)
    {
        $this->imageService->delete($trainer->photo);
        $trainer->delete();
        return redirect()->route('admin.trainers.index')->with('success', 'Entrenador eliminado.');
    }
}