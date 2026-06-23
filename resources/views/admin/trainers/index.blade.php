@extends('layouts.app')

@section('content')
<main class="contenido-principal" style="display: flex; justify-content: center; align-items: center; min-height: 100vh; width: 100%; padding: 20px;">
    <div style="width: 100%; max-width: 1200px;">
        <!-- Encabezado -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="background-color: #1a3a6b; width: 50px; height: 50px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                <i class="bi bi-person-badge" style="color: white; font-size: 24px;"></i>
            </div>
            <h2 style="color: #1a3a6b; font-weight: 700; font-size: 1.8rem;">Gestión de Entrenadores</h2>
            <p style="color: #5a6b7c; font-size: 1rem;">Administra los entrenadores del gimnasio</p>
        </div>

        <!-- Botón Nuevo Entrenador -->
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('admin.trainers.create') }}" class="btn" style="background-color: #1a3a6b; color: white; padding: 10px 25px; border-radius: 50px; text-decoration: none; transition: 0.3s; font-weight: 500; box-shadow: 0 4px 12px rgba(26, 58, 107, 0.2);">
                <i class="bi bi-plus-circle me-1"></i> Nuevo Entrenador
            </a>
        </div>

        <!-- Mensajes de éxito -->
        @if(session('success'))
            <div class="alert alert-success" style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 12px 20px; border-radius: 8px; margin-bottom: 1rem;">
                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Tarjeta de la tabla -->
        <div class="card shadow-lg border-0" style="border-radius: 16px; overflow: hidden; width: 100%;">
            <div class="card-body p-0">
                <!-- ✅ CONTENEDOR FLEX PARA CENTRAR LA TABLA -->
                <div style="display: flex; justify-content: center;">
                    <div class="table-responsive" style="width: 100%; max-width: 1200px;">
                        <table class="table table-hover mb-0" style="font-size: 14px; width: 100%;">
                            <thead style="background-color: #1a3a6b; color: white; text-align: center;">
                                <tr>
                                    <th style="width: 60px; padding: 12px 8px;">ID</th>
                                    <th style="padding: 12px 8px;">Nombre</th>
                                    <th style="padding: 12px 8px;">Especialidad</th>
                                    <th style="width: 120px; padding: 12px 8px;">Foto</th>
                                    <th style="width: 220px; padding: 12px 8px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($trainers as $trainer)
                                <tr style="text-align: center; vertical-align: middle;">
                                    <td style="padding: 10px 8px; font-weight: 600;">{{ $trainer->id }}</td>
                                    <td style="padding: 10px 8px; font-weight: 500;">{{ $trainer->name }}</td>
                                    <td style="padding: 10px 8px; color: #5a6b7c;">{{ $trainer->specialty ?? '—' }}</td>
                                    <td style="padding: 10px 8px;">
                                        @if($trainer->photo)
                                            <img src="{{ asset('storage/' . $trainer->photo) }}" alt="Foto" style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover; border: 2px solid #e9ecef;">
                                        @else
                                            <span class="text-muted" style="color: #6c757d; font-size: 0.8rem;">Sin foto</span>
                                        @endif
                                    </td>
                                    <td style="padding: 10px 8px; text-align: center; vertical-align: middle;">
                                        <div class="d-flex justify-content-center gap-2" style="flex-wrap: nowrap;">
                                            <a href="{{ route('admin.trainers.edit', $trainer) }}" class="btn btn-sm" style="background-color: #1a3a6b; color: white; padding: 6px 14px; border-radius: 50px; text-decoration: none; transition: 0.3s; font-size: 0.8rem; font-weight: 500; white-space: nowrap;">
                                                <i class="bi bi-pencil-square me-1"></i> Editar
                                            </a>
                                            <form action="{{ route('admin.trainers.destroy', $trainer) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm" style="background-color: #dc3545; color: white; padding: 6px 14px; border-radius: 50px; border: none; transition: 0.3s; font-size: 0.8rem; font-weight: 500; white-space: nowrap;" onclick="return confirm('¿Eliminar este entrenador?')">
                                                    <i class="bi bi-trash me-1"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <i class="bi bi-person-badge" style="font-size: 3rem; color: #ccc;"></i>
                                        <p class="text-muted mt-3" style="color: #5a6b7c;">No hay entrenadores registrados.</p>
                                        <a href="{{ route('admin.trainers.create') }}" class="btn" style="background-color: #1a3a6b; color: white; padding: 10px 25px; border-radius: 50px; text-decoration: none; transition: 0.3s; font-weight: 500; box-shadow: 0 4px 12px rgba(26, 58, 107, 0.2);">
                                            <i class="bi bi-plus-circle me-1"></i> Crear primer entrenador
                                        </a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Footer con estadísticas -->
                <div class="card-footer" style="background-color: #f8f9fa; border-top: 1px solid #e9ecef; padding: 12px 20px; text-align: center; border-radius: 0 0 16px 16px;">
                    <span class="text-muted" style="color: #5a6b7c;">
                        Total: <strong style="color: #1a3a6b;">{{ $trainers->count() }}</strong> entrenadores
                    </span>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
