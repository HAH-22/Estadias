@extends('layouts.app')

@section('content')
<main class="contenido-principal" style="display: flex; justify-content: center; align-items: center; min-height: 100vh; width: 100%; padding: 20px;">
    <div style="width: 100%; max-width: 900px;">
        <!-- Encabezado -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="background-color: #1a3a6b; width: 50px; height: 50px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                <i class="bi bi-plus-circle" style="color: white; font-size: 24px;"></i>
            </div>
            <h2 style="color: #1a3a6b; font-weight: 700; font-size: 1.8rem;">Crear Carrusel</h2>
            <p style="color: #5a6b7c; font-size: 1rem;">Agrega una nueva imagen al carrusel</p>
        </div>

        <div class="card shadow-lg border-0" style="border-radius: 16px; overflow: hidden; width: 100%;">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.slides.store') }}" enctype="multipart/form-data" style="display: flex; flex-direction: column; align-items: center;">
                    @csrf

                    <!-- Título -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="title" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-tag me-1"></i> Título (opcional)
                        </label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Subtítulo -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="subtitle" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-fonts me-1"></i> Subtítulo (opcional)
                        </label>
                        <input type="text" name="subtitle" id="subtitle" class="form-control" value="{{ old('subtitle') }}" style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('subtitle') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Imagen -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="image" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-image me-1"></i> Imagen *
                        </label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*" required style="border-radius: 8px; border: 2px solid #e9ecef; padding: 10px 14px; font-size: 1rem; width: 100%;">
                        <small class="text-muted">Formatos: JPG, PNG, GIF. Máx 2MB.</small>
                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Enlace -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="link" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-link-45deg me-1"></i> Enlace (opcional)
                        </label>
                        <input type="url" name="link" id="link" class="form-control" value="{{ old('link') }}" placeholder="https://..." style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('link') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Orden -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="order" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-sort-numeric-down me-1"></i> Orden
                        </label>
                        <input type="number" name="order" id="order" class="form-control" value="{{ old('order', 0) }}" style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('order') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Activo -->
                    <div class="mb-4" style="width: 100%; max-width: 500px; text-align: left;">
                        <div class="form-check">
                            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ old('is_active') ? 'checked' : '' }}>
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
                        <a href="{{ route('admin.slides.index') }}" class="btn" style="background-color: #6c757d; color: white; padding: 10px 35px; border-radius: 50px; border: none; font-weight: 600; font-size: 0.95rem; text-decoration: none;">
                            <i class="bi bi-x-circle me-1"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection