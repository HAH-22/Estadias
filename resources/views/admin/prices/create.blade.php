@extends('layouts.app')

@section('content')
<main class="contenido-principal" style="display: flex; justify-content: center; align-items: center; min-height: 100vh; width: 100%; padding: 20px;">
    <div style="width: 100%; max-width: 600px;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="background-color: #1a3a6b; width: 50px; height: 50px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                <i class="bi bi-plus-circle" style="color: white; font-size: 24px;"></i>
            </div>
            <h2 style="color: #1a3a6b; font-weight: 700; font-size: 1.8rem;">Crear Precio</h2>
            <p style="color: #5a6b7c; font-size: 1rem;">Registra un nuevo precio</p>
        </div>

        <div class="card shadow-lg border-0" style="border-radius: 16px; overflow: hidden; width: 100%;">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.prices.store') }}" style="display: flex; flex-direction: column; align-items: center;">
                    @csrf

                    <div class="mb-3" style="width: 100%; max-width: 400px;">
                        <label for="name" class="form-label" style="color: #1a3a6b; font-weight: 600;">
                            <i class="bi bi-tag me-1"></i> Nombre
                        </label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required
                               placeholder="Ej: Inscripción, Mensual, Anualidad..."
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3" style="width: 100%; max-width: 400px;">
                        <label for="price" class="form-label" style="color: #1a3a6b; font-weight: 600;">
                            <i class="bi bi-currency-dollar me-1"></i> Precio
                        </label>
                        <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price') }}" required
                               placeholder="Ej: 100.00"
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3" style="width: 100%; max-width: 400px;">
                        <label for="order" class="form-label" style="color: #1a3a6b; font-weight: 600;">
                            <i class="bi bi-sort-numeric-down me-1"></i> Orden
                        </label>
                        <input type="number" name="order" id="order" class="form-control" value="{{ old('order', 0) }}"
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('order') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4" style="width: 100%; max-width: 400px; text-align: left;">
                        <div class="form-check">
                            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ old('is_active') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active" style="color: #1a3a6b; font-weight: 500;">
                                <i class="bi bi-check-circle me-1"></i> Activo
                            </label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-3 mt-2">
                        <button type="submit" class="btn-crear">
                            <i class="bi bi-check-circle me-1"></i> Guardar
                        </button>
                        <a href="{{ route('admin.prices.index') }}" class="btn-cancelar">
                            <i class="bi bi-x-circle me-1"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection