@extends('layouts.app')

@section('content')
<main class="contenido-principal" style="display: flex; justify-content: center; align-items: center; min-height: 100vh; width: 100%; padding: 20px;">
    <div style="width: 100%; max-width: 900px;">
        <!-- Encabezado -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="background-color: #1a3a6b; width: 50px; height: 50px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                <i class="bi bi-plus-circle" style="color: white; font-size: 24px;"></i>
            </div>
            <h2 style="color: #1a3a6b; font-weight: 700; font-size: 1.8rem;">Crear Plan</h2>
            <p style="color: #5a6b7c; font-size: 1rem;">Registra un nuevo plan de membresía</p>
        </div>

        <!-- Tarjeta -->
        <div class="card shadow-lg border-0" style="border-radius: 16px; overflow: hidden; width: 100%;">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.plans.store') }}" 
                      style="display: flex; flex-direction: column; align-items: center;">
                    @csrf

                    <!-- Nombre -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="name" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-tag me-1"></i> Nombre del Plan
                        </label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Precio e Inscripción -->
                    <div class="row g-2 mb-3" style="width: 100%; max-width: 500px;">
                        <div class="col-6">
                            <label for="price" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                                <i class="bi bi-currency-dollar me-1"></i> Precio Mensual
                            </label>
                            <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price') }}" required
                                   style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                            @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-6">
                            <label for="inscription_fee" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                                <i class="bi bi-file-earmark-plus me-1"></i> Inscripción
                            </label>
                            <input type="number" step="0.01" name="inscription_fee" id="inscription_fee" class="form-control" value="{{ old('inscription_fee') }}"
                                   style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                            @error('inscription_fee') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
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

                    <!-- Características -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="features" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-list-ul me-1"></i> Características (cada línea)
                        </label>
                        <textarea name="features" id="features" rows="4" class="form-control"
                                  style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">{{ old('features') }}</textarea>
                        @error('features') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Botones -->
                    <div class="d-flex justify-content-center gap-3 mt-3">
                        <button type="submit" class="btn" style="background-color: #1a3a6b; color: white; padding: 10px 35px; border-radius: 50px; border: none; font-weight: 600; font-size: 0.95rem; box-shadow: 0 4px 12px rgba(26, 58, 107, 0.3);">
                            <i class="bi bi-check-circle me-1"></i> Guardar
                        </button>
                        <a href="{{ route('admin.plans.index') }}" class="btn" style="background-color: #6c757d; color: white; padding: 10px 35px; border-radius: 50px; border: none; font-weight: 600; font-size: 0.95rem; text-decoration: none;">
                            <i class="bi bi-x-circle me-1"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

<style>
    .btn {
        transition: all 0.2s;
    }
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }
    .form-control:focus {
        border-color: #1a3a6b;
        box-shadow: 0 0 0 0.2rem rgba(26, 58, 107, 0.15);
        outline: none;
    }
    .form-control:hover {
        border-color: #1a3a6b;
    }
    .form-control {
        transition: all 0.3s;
        width: 100% !important;
    }
    .contenido-principal {
        width: 100%;
        margin: 0;
    }
</style>