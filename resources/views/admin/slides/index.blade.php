@extends('layouts.app')

@section('content')
<main class="contenido-principal" style="display: flex; justify-content: center; align-items: center; min-height: 100vh; width: 100%; padding: 20px;">
    <div style="width: 100%; max-width: 1200px;">
        <!-- Encabezado -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="background-color: #1a3a6b; width: 50px; height: 50px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                <i class="bi bi-images" style="color: white; font-size: 24px;"></i>
            </div>
            <h2 style="color: #1a3a6b; font-weight: 700; font-size: 1.8rem;">Gestión de Carrusel</h2>
            <p style="color: #5a6b7c; font-size: 1rem;">Administra las imágenes del carrusel</p>
        </div>

        <!-- Botón Nuevo Slide -->
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('admin.slides.create') }}" class="btn" style="background-color: #1a3a6b; color: white; padding: 10px 25px; border-radius: 50px; text-decoration: none; transition: 0.3s; font-weight: 500; box-shadow: 0 4px 12px rgba(26, 58, 107, 0.2);">
                <i class="bi bi-plus-circle me-1"></i> Nuevo Carrusel
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success" style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 12px 20px; border-radius: 8px; margin-bottom: 1rem;">
                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-lg border-0" style="border-radius: 16px; overflow: hidden; width: 100%;">
            <div class="card-body p-0">
                <div style="display: flex; justify-content: center;">
                    <div class="table-responsive" style="width: 100%; max-width: 100%;">
                        <table class="table table-hover mb-0" style="font-size: 14px; width: 100%; min-width: 768px;">
                            <thead style="background-color: #1a3a6b; color: white; text-align: center;">
                                <tr>
                                    <th style="width: 50px; padding: 12px 6px;">ID</th>
                                    <th style="min-width: 150px; padding: 12px 6px;">Título</th>
                                    <th style="min-width: 180px; padding: 12px 6px;">Subtítulo</th>
                                    <th style="width: 120px; padding: 12px 6px;">Imagen</th>
                                    <th style="width: 80px; padding: 12px 6px;">Orden</th>
                                    <th style="width: 100px; padding: 12px 6px;">Estado</th>
                                    <th style="width: 220px; padding: 12px 6px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($slides as $slide)
                                <tr style="text-align: center; vertical-align: middle;">
                                    <td style="padding: 10px 6px; font-weight: 600;">{{ $slide->id }}</td>
                                    <td style="padding: 10px 6px;">{{ $slide->title ?: '—' }}</td>
                                    <td style="padding: 10px 6px; color: #5a6b7c;">{{ $slide->subtitle ?: '—' }}</td>
                                    <td style="padding: 10px 6px;">
                                        @if($slide->image)
                                            <img src="{{ asset('storage/' . $slide->image) }}" alt="Slide" style="width: 60px; height: 40px; object-fit: cover; border-radius: 6px;">
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td style="padding: 10px 6px;">{{ $slide->order }}</td>
                                    <td style="padding: 10px 6px;">
                                        @if($slide->is_active)
                                            <span class="badge" style="background-color: #28a745; color: white; padding: 5px 14px; border-radius: 50px; font-weight: 500; font-size: 0.8rem;">
                                                <i class="bi bi-check-circle me-1"></i> Activo
                                            </span>
                                        @else
                                            <span class="badge" style="background-color: #dc3545; color: white; padding: 5px 14px; border-radius: 50px; font-weight: 500; font-size: 0.8rem;">
                                                <i class="bi bi-x-circle me-1"></i> Inactivo
                                            </span>
                                        @endif
                                    </td>
                                    <td style="padding: 10px 6px; text-align: center; vertical-align: middle;">
                                        <div class="d-flex justify-content-center gap-2" style="flex-wrap: nowrap;">
                                            <a href="{{ route('admin.slides.edit', $slide) }}" class="btn btn-sm" style="background-color: #1a3a6b; color: white; padding: 8px 18px; border-radius: 50px; text-decoration: none; transition: 0.3s; font-size: 0.85rem; font-weight: 500; white-space: nowrap;">
                                                <i class="bi bi-pencil-square me-1"></i> Editar
                                            </a>
                                            <form action="{{ route('admin.slides.destroy', $slide) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm" style="background-color: #dc3545; color: white; padding: 8px 18px; border-radius: 50px; border: none; transition: 0.3s; font-size: 0.85rem; font-weight: 500; white-space: nowrap;" onclick="return confirm('¿Eliminar este slide?')">
                                                    <i class="bi bi-trash me-1"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <i class="bi bi-images" style="font-size: 3rem; color: #ccc;"></i>
                                        <p class="text-muted mt-3" style="color: #5a6b7c;">No hay carruseles registrados.</p>
                                        <a href="{{ route('admin.slides.create') }}" class="btn" style="background-color: #1a3a6b; color: white; padding: 10px 25px; border-radius: 50px; text-decoration: none; transition: 0.3s; font-weight: 500; box-shadow: 0 4px 12px rgba(26, 58, 107, 0.2);">
                                            <i class="bi bi-plus-circle me-1"></i> Crear primer carrusel
                                        </a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer" style="background-color: #f8f9fa; border-top: 1px solid #e9ecef; padding: 12px 20px; text-align: center; border-radius: 0 0 16px 16px;">
                    <span class="text-muted" style="color: #5a6b7c;">
                        Total: <strong style="color: #1a3a6b;">{{ $slides->count() }}</strong> carruseles
                    </span>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection