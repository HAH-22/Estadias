@extends('layouts.app')

@section('content')
<main class="contenido-principal" style="display: flex; justify-content: center; align-items: center; min-height: 100vh; width: 100%; padding: 20px;">
    <div style="width: 100%; max-width: 900px;">
        <!-- Encabezado -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="background-color: #1a3a6b; width: 50px; height: 50px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                <i class="bi bi-plus-circle" style="color: white; font-size: 24px;"></i>
            </div>
            <h2 style="color: #1a3a6b; font-weight: 700; font-size: 1.8rem;">Crear Servicio</h2>
            <p style="color: #5a6b7c; font-size: 1rem;">Registra un nuevo servicio para el gimnasio</p>
        </div>

        <!-- Tarjeta -->
        <div class="card shadow-lg border-0" style="border-radius: 16px; overflow: hidden; width: 100%;">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data"
                      style="display: flex; flex-direction: column; align-items: center;">
                    @csrf

                    <!-- Título -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="title" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-tag me-1"></i> Título
                        </label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Descripción -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="description" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-text-paragraph me-1"></i> Descripción
                        </label>
                        <textarea name="description" id="description" rows="3" class="form-control"
                                  style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">{{ old('description') }}</textarea>
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Imagen -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="image" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-image me-1"></i> Imagen (opcional)
                        </label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*"
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 10px 14px; font-size: 1rem; width: 100%;">
                        <small class="text-muted" style="display: block; margin-top: 4px;">Formatos: JPG, PNG, GIF. Máx 2MB.</small>
                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Orden -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="order" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-sort-numeric-down me-1"></i> Orden
                        </label>
                        <input type="number" name="order" id="order" class="form-control" value="{{ old('order', 0) }}"
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        <small class="text-muted" style="display: block; margin-top: 4px;">Número más bajo = aparece primero</small>
                        @error('order') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Activo -->
                    <div class="mb-4" style="width: 100%; max-width: 500px; text-align: left;">
                        <div class="form-check">
                            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ old('is_active') ? 'checked' : '' }}
                                   style="border-radius: 4px; border-color: #ced4da; width: 18px; height: 18px; margin-top: 0.2rem;">
                            <label class="form-check-label" for="is_active" style="color: #1a3a6b; font-weight: 500;">
                                <i class="bi bi-check-circle me-1"></i> Activo
                            </label>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="d-flex justify-content-center gap-3 mt-2">
                        <button type="submit" class="btn" style="background-color: #1a3a6b; color: white; padding: 10px 35px; border-radius: 50px; border: none; font-weight: 600; font-size: 0.95rem; box-shadow: 0 4px 12px rgba(26, 58, 107, 0.3);">
                            <i class="bi bi-check-circle me-1"></i> Guardar
                        </button>
                        <a href="{{ route('admin.services.index') }}" class="btn" style="background-color: #6c757d; color: white; padding: 10px 35px; border-radius: 50px; border: none; font-weight: 600; font-size: 0.95rem; text-decoration: none;">
                            <i class="bi bi-x-circle me-1"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
