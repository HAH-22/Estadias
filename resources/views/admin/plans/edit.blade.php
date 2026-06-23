@extends('layouts.app')

@section('content')
<main class="contenido-principal" style="display: flex; justify-content: center; align-items: center; min-height: 100vh; width: 100%; padding: 20px;">
    <div style="width: 100%; max-width: 900px;">
        <!-- Encabezado -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="background-color: #1a3a6b; width: 50px; height: 50px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                <i class="bi bi-pencil-square" style="color: white; font-size: 24px;"></i>
            </div>
            <h2 style="color: #1a3a6b; font-weight: 700; font-size: 1.8rem;">Editar Plan</h2>
            <p style="color: #5a6b7c; font-size: 1rem;">Modifica los datos del plan de membresía</p>
        </div>

        <!-- Tarjeta -->
        <div class="card shadow-lg border-0" style="border-radius: 16px; overflow: hidden; width: 100%;">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.plans.update', $plan) }}" 
                      style="display: flex; flex-direction: column; align-items: center;">
                    @csrf
                    @method('PUT')

                    <!-- Nombre -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="name" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-tag me-1"></i> Nombre del Plan
                        </label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $plan->name) }}" required
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Precio e Inscripción -->
                    <div class="row g-2 mb-3" style="width: 100%; max-width: 500px;">
                        <div class="col-6">
                            <label for="price" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                                <i class="bi bi-currency-dollar me-1"></i> Precio
                            </label>
                            <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price', $plan->price) }}" required
                                   style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                            @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-6">
                            <label for="inscription_fee" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                                <i class="bi bi-file-earmark-plus me-1"></i> Inscripción
                            </label>
                            <input type="number" step="0.01" name="inscription_fee" id="inscription_fee" class="form-control" value="{{ old('inscription_fee', $plan->inscription_fee) }}"
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
                                  style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">{{ old('description', $plan->description) }}</textarea>
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Características -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="features" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-list-ul me-1"></i> Características
                        </label>
                        <textarea name="features" id="features" rows="4" class="form-control"
                                  style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">{{ old('features', $plan->features) }}</textarea>
                        @error('features') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Botones -->
                    <div class="d-flex justify-content-center gap-3 mt-3">
                        <button type="submit" class="btn" style="background-color: #1a3a6b; color: white; padding: 10px 35px; border-radius: 50px; border: none; font-weight: 600; font-size: 0.95rem; box-shadow: 0 4px 12px rgba(26, 58, 107, 0.3);">
                            <i class="bi bi-check-circle me-1"></i> Actualizar
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