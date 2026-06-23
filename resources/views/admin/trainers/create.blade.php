@extends('layouts.app')

@section('content')
<main class="contenido-principal" style="display: flex; justify-content: center; align-items: center; min-height: 100vh; width: 100%; padding: 20px;">
    <div style="width: 100%; max-width: 900px;">
        <!-- Encabezado -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="background-color: #1a3a6b; width: 50px; height: 50px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                <i class="bi bi-person-badge" style="color: white; font-size: 24px;"></i>
            </div>
            <h2 style="color: #1a3a6b; font-weight: 700; font-size: 1.8rem;">Crear Entrenador</h2>
            <p style="color: #5a6b7c; font-size: 1rem;">Registra un nuevo entrenador en el sistema</p>
        </div>

        <!-- Tarjeta -->
        <div class="card shadow-lg border-0" style="border-radius: 16px; overflow: hidden; width: 100%;">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.trainers.store') }}" enctype="multipart/form-data"
                      style="display: flex; flex-direction: column; align-items: center;">
                    @csrf

                    <!-- Nombre -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="name" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-person me-1"></i> Nombre
                        </label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Especialidad -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="specialty" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-trophy me-1"></i> Especialidad
                        </label>
                        <input type="text" name="specialty" id="specialty" class="form-control" value="{{ old('specialty') }}"
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('specialty') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Biografía -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="bio" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-text-paragraph me-1"></i> Biografía
                        </label>
                        <textarea name="bio" id="bio" rows="4" class="form-control"
                                  style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">{{ old('bio') }}</textarea>
                        @error('bio') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Foto -->
                    <div class="mb-4" style="width: 100%; max-width: 500px;">
                        <label for="photo" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-image me-1"></i> Foto
                        </label>
                        <input type="file" name="photo" id="photo" class="form-control" accept="image/*"
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 10px 14px; font-size: 1rem; width: 100%;">
                        <small class="text-muted" style="display: block; margin-top: 4px;">Formatos: JPG, PNG. Máx 2MB.</small>
                        @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Botones -->
                    <div class="d-flex justify-content-center gap-3 mt-2">
                        <button type="submit" class="btn" style="background-color: #1a3a6b; color: white; padding: 10px 35px; border-radius: 50px; border: none; font-weight: 600; font-size: 0.95rem; box-shadow: 0 4px 12px rgba(26, 58, 107, 0.3);">
                            <i class="bi bi-check-circle me-1"></i> Guardar
                        </button>
                        <a href="{{ route('admin.trainers.index') }}" class="btn" style="background-color: #6c757d; color: white; padding: 10px 35px; border-radius: 50px; border: none; font-weight: 600; font-size: 0.95rem; text-decoration: none;">
                            <i class="bi bi-x-circle me-1"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
