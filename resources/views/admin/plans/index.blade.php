@extends('layouts.app')

@section('content')
<main class="contenido-principal" style="display: flex; justify-content: center; align-items: center; min-height: 100vh; width: 100%; padding: 20px;">
    <div style="width: 100%; max-width: 1200px;">
        <!-- Encabezado -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="background-color: #1a3a6b; width: 50px; height: 50px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                <i class="bi bi-grid" style="color: white; font-size: 24px;"></i>
            </div>
            <h2 style="color: #1a3a6b; font-weight: 700; font-size: 1.8rem;">Gestión de Planes</h2>
            <p style="color: #5a6b7c; font-size: 1rem;">Administra los planes de membresía del gimnasio</p>
        </div>

        <!-- Botón Nuevo Plan -->
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('admin.plans.create') }}" class="btn" style="background-color: #1a3a6b; color: white; padding: 10px 25px; border-radius: 50px; text-decoration: none; transition: 0.3s; font-weight: 500; box-shadow: 0 4px 12px rgba(26, 58, 107, 0.2);">
                <i class="bi bi-plus-circle me-1"></i> Nuevo Plan
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
        <!-- Contenedor flex para centrar la tabla -->
        <div style="display: flex; justify-content: center;">
            <div class="table-responsive" style="width: 100%; max-width: 100%;">
                <table class="table table-hover mb-0" style="font-size: 14px; width: 100%; min-width: 768px;">
                    <thead style="background-color: #1a3a6b; color: white; text-align: center;">
                        <tr>
                            <th style="width: 50px; padding: 12px 8px;">ID</th>
                            <th style="min-width: 120px; padding: 12px 8px;">Nombre</th>
                            <th style="width: 110px; padding: 12px 8px;">Precio</th>
                            <th style="width: 110px; padding: 12px 8px;">Inscripción</th>
                            <th style="width: 140px; padding: 12px 8px;">Descripción</th>
                            <th style="min-width: 160px; padding: 12px 8px;">Características</th>
                            <th style="width: 220px; padding: 12px 8px;">Acciones</th> <!-- Más ancho -->
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($plans as $plan)
                        <tr style="vertical-align: middle;">
                            <td style="padding: 10px 8px; text-align: center; font-weight: 600;">{{ $plan->id }}</td>
                            <td style="padding: 10px 8px; font-weight: 500; text-align: center;">{{ $plan->name }}</td>
                            <td style="padding: 10px 8px; text-align: center; color: #28a745; font-weight: 600;">${{ number_format($plan->price, 2) }}</td>
                            <td style="padding: 10px 8px; text-align: center;">${{ number_format($plan->inscription_fee, 2) }}</td>
                            <td style="padding: 10px 8px; color: #5a6b7c; text-align: center; font-size: 0.9rem;">
                                {{ Str::limit($plan->description, 25) }}
                            </td>
                            <td style="padding: 10px 8px;">
                                <ul style="margin: 0; padding-left: 16px; text-align: left; font-size: 0.85rem; color: #5a6b7c;">
                                    @foreach(explode("\n", $plan->features ?? '') as $feature)
                                        <li style="line-height: 1.4;">{{ $feature }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td style="padding: 10px 8px; text-align: center; vertical-align: middle;">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.plans.edit', $plan) }}" class="btn btn-sm" style="background-color: #1a3a6b; color: white; padding: 8px 18px; border-radius: 50px; text-decoration: none; transition: 0.3s; font-size: 0.85rem; font-weight: 500;">
                                        <i class="bi bi-pencil-square me-1"></i> Editar
                                    </a>
                                    <form action="{{ route('admin.plans.destroy', $plan) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm" style="background-color: #dc3545; color: white; padding: 8px 18px; border-radius: 50px; border: none; transition: 0.3s; font-size: 0.85rem; font-weight: 500;" onclick="return confirm('¿Eliminar este plan?')">
                                            <i class="bi bi-trash me-1"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-grid" style="font-size: 3rem; color: #ccc;"></i>
                                <p class="text-muted mt-3" style="color: #5a6b7c;">No hay planes registrados todavía.</p>
                                <a href="{{ route('admin.plans.create') }}" class="btn" style="background-color: #1a3a6b; color: white; padding: 10px 25px; border-radius: 50px; text-decoration: none; transition: 0.3s; font-weight: 500; box-shadow: 0 4px 12px rgba(26, 58, 107, 0.2);">
                                    <i class="bi bi-plus-circle me-1"></i> Crear primer plan
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
                Total: <strong style="color: #1a3a6b;">{{ $plans->count() }}</strong> planes
            </span>
        </div>
    </div>
</div>
</main>
@endsection
