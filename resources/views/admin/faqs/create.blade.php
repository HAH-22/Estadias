@extends('layouts.app')

@section('content')
<main class="contenido-principal" style="display: flex; justify-content: center; align-items: center; min-height: 100vh; width: 100%; padding: 20px;">
    <div style="width: 100%; max-width: 600px;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="background-color: #1a3a6b; width: 50px; height: 50px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                <i class="bi bi-plus-circle" style="color: white; font-size: 24px;"></i>
            </div>
            <h2 style="color: #1a3a6b; font-weight: 700; font-size: 1.8rem;">Nueva Pregunta Frecuente</h2>
            <p style="color: #5a6b7c; font-size: 1rem;">Registra una pregunta y su respuesta para el chatbot</p>
        </div>

        <div class="card shadow-lg border-0" style="border-radius: 16px; overflow: hidden; width: 100%;">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.faqs.store') }}" style="display: flex; flex-direction: column; align-items: center;">
                    @csrf

                    <div class="mb-3" style="width: 100%; max-width: 400px;">
                        <label for="question" class="form-label" style="color: #1a3a6b; font-weight: 600;">
                            <i class="bi bi-tag me-1"></i> Pregunta / Palabra clave
                        </label>
                        <input type="text" name="question" id="question" class="form-control" value="{{ old('question') }}" required
                               placeholder="Ej: precios, horarios, ubicación..."
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('question') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3" style="width: 100%; max-width: 400px;">
                        <label for="answer" class="form-label" style="color: #1a3a6b; font-weight: 600;">
                            <i class="bi bi-text-paragraph me-1"></i> Respuesta
                        </label>
                        <textarea name="answer" id="answer" rows="4" class="form-control" required
                                  style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">{{ old('answer') }}</textarea>
                        @error('answer') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3" style="width: 100%; max-width: 400px;">
                        <label for="keyword" class="form-label" style="color: #1a3a6b; font-weight: 600;">
                            <i class="bi bi-search me-1"></i> Palabra clave adicional (opcional)
                        </label>
                        <input type="text" name="keyword" id="keyword" class="form-control" value="{{ old('keyword') }}"
                               placeholder="Ej: costo, abrir, donde..."
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('keyword') <span class="text-danger">{{ $message }}</span> @enderror
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
                        <a href="{{ route('admin.faqs.index') }}" class="btn-cancelar">
                            <i class="bi bi-x-circle me-1"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection