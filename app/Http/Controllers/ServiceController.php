<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $services = Service::orderBy('order')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',        // opcional, si lo mantienes
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        // Preparar datos (excluir imagen y token)
        $data = $request->except(['image', '_token']);

        // Subir imagen si existe
        if ($request->hasFile('image')) {
            $data['image'] = $this->imageService->upload($request->file('image'), 'services');
        }

        // Crear el servicio
        Service::create($data);

        return redirect()->route('admin.services.index')
            ->with('success', 'Servicio creado correctamente.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'image' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        // Preparar datos (excluir imagen, token y método)
        $data = $request->except(['image', '_token', '_method']);

        // Reemplazar imagen si se sube una nueva
        if ($request->hasFile('image')) {
            $data['image'] = $this->imageService->replace(
                $request->file('image'),
                $service->image,
                'services'
            );
        }

        // Actualizar el servicio
        $service->update($data);

        return redirect()->route('admin.services.index')
            ->with('success', 'Servicio actualizado.');
    }

    public function destroy(Service $service)
    {
        // Eliminar la imagen asociada
        if ($service->image) {
            $this->imageService->delete($service->image);
        }

        // Eliminar el registro
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Servicio eliminado.');
    }
}