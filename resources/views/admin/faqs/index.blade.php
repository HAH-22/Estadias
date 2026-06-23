@extends('layouts.app')

@section('content')
<main class="contenido-principal" style="display: flex; justify-content: center; align-items: center; min-height: 100vh; width: 100%; padding: 20px;">
    <div style="width: 100%; max-width: 1000px;">
        <!-- Encabezado -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="background-color: #1a3a6b; width: 50px; height: 50px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                <i class="bi bi-question-circle" style="color: white; font-size: 24px;"></i>
            </div>
            <h2 style="color: #1a3a6b; font-weight: 700; font-size: 1.8rem;">Preguntas Frecuentes</h2>
            <p style="color: #5a6b7c; font-size: 1rem;">Gestiona las respuestas del chatbot</p>
        </div>

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('admin.faqs.create') }}" class="btn-crear">
                <i class="bi bi-plus-circle me-1"></i> Nueva Pregunta
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-lg border-0" style="border-radius: 16px; overflow: hidden; width: 100%;">
            <div class="card-body p-0">
                <div style="display: flex; justify-content: center;">
                    <div class="table-responsive" style="width: 100%; max-width: 100%;">
                        <table class="table table-hover mb-0" style="font-size: 14px; width: 100%;">
                            <thead style="background-color: #1a3a6b; color: white; text-align: center;">
                                <tr>
                                    <th style="width: 50px; padding: 12px 6px;">ID</th>
                                    <th style="min-width: 150px; padding: 12px 6px;">Pregunta</th>
                                    <th style="min-width: 250px; padding: 12px 6px;">Respuesta</th>
                                    <th style="min-width: 150px; padding: 12px 6px;">Palabra clave</th>
                                    <th style="width: 120px; padding: 12px 6px;">Estado</th>
                                    <th style="width: 220px; padding: 12px 6px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($faqs as $faq)
                                <tr style="text-align: center; vertical-align: middle;">
                                    <td style="padding: 10px 6px; font-weight: 600;">{{ $faq->id }}</td>
                                    <td style="padding: 10px 6px; font-weight: 500;">{{ Str::limit($faq->question, 30) }}</td>
                                    <td style="padding: 10px 6px; color: #5a6b7c;">{{ Str::limit($faq->answer, 60) }}</td>
                                    <td style="padding: 10px 6px;">{{ $faq->keyword ?? '—' }}</td>
                                    <td style="padding: 10px 6px;">
                                        @if($faq->is_active)
                                            <span class="badge-abierto">Activo</span>
                                        @else
                                            <span class="badge-cerrado">Inactivo</span>
                                        @endif
                                    </td>
                                    <td style="padding: 10px 6px; text-align: center; vertical-align: middle;">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn-editar">
                                                <i class="bi bi-pencil-square me-1"></i> Editar
                                            </a>
                                            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-eliminar" onclick="return confirm('¿Eliminar esta pregunta?')">
                                                    <i class="bi bi-trash me-1"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <i class="bi bi-question-circle" style="font-size: 3rem; color: #ccc;"></i>
                                        <p class="text-muted mt-3">No hay preguntas frecuentes registradas.</p>
                                        <a href="{{ route('admin.faqs.create') }}" class="btn-crear">
                                            <i class="bi bi-plus-circle me-1"></i> Crear primera pregunta
                                        </a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer" style="background-color: #f8f9fa; border-top: 1px solid #e9ecef; padding: 12px 20px; text-align: center;">
                    <span class="text-muted">
                        Total: <strong style="color: #1a3a6b;">{{ $faqs->count() }}</strong> preguntas
                    </span>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection