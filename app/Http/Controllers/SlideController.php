<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use App\Services\ImageService;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $slides = Slide::orderBy('order')->get();
        return view('admin.slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.slides.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url|max:255',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $this->imageService->upload($request->file('image'), 'slides');
        }

        Slide::create($data);

        return redirect()->route('admin.slides.index')
            ->with('success', 'Slide creado correctamente.');
    }

    public function edit(Slide $slide)
    {
        return view('admin.slides.edit', compact('slide'));
    }

    public function update(Request $request, Slide $slide)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url|max:255',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($slide->image) {
                $this->imageService->delete($slide->image);
            }
            $data['image'] = $this->imageService->upload($request->file('image'), 'slides');
        }

        $slide->update($data);

        return redirect()->route('admin.slides.index')
            ->with('success', 'Slide actualizado correctamente.');
    }

    public function destroy(Slide $slide)
    {
        // Eliminar imagen asociada
        if ($slide->image) {
            $this->imageService->delete($slide->image);
        }
        $slide->delete();

        return redirect()->route('admin.slides.index')
            ->with('success', 'Slide eliminado correctamente.');
    }
}