@extends('layouts.app')

@section('content')
<main class="contenido-principal" style="display: flex; justify-content: center; align-items: center; min-height: 100vh; width: 100%; padding: 20px;">
    <div style="width: 100%; max-width: 1000px;">
        <!-- Encabezado -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="background-color: #1a3a6b; width: 50px; height: 50px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                <i class="bi bi-share" style="color: white; font-size: 24px;"></i>
            </div>
            <h2 style="color: #1a3a6b; font-weight: 700; font-size: 1.8rem;">Redes Sociales</h2>
            <p style="color: #5a6b7c; font-size: 1rem;">Administra las redes sociales del gimnasio</p>
        </div>

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('admin.social-networks.create') }}" class="btn-crear">
                <i class="bi bi-plus-circle me-1"></i> Nueva Red Social
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
                        <table class="table table-hover mb-0" style="font-size: 14px; width: 100%; min-width: 600px;">
                            <thead style="background-color: #1a3a6b; color: white; text-align: center;">
                                <tr>
                                    <th style="width: 50px; padding: 12px 6px;">ID</th>
                                    <th style="min-width: 120px; padding: 12px 6px;">Nombre</th>
                                    <th style="min-width: 120px; padding: 12px 6px;">Icono</th>
                                    <th style="min-width: 200px; padding: 12px 6px;">URL</th>
                                    <th style="width: 100px; padding: 12px 6px;">Orden</th>
                                    <th style="width: 120px; padding: 12px 6px;">Estado</th>
                                    <th style="width: 220px; padding: 12px 6px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($networks as $network)
                                <tr style="text-align: center; vertical-align: middle;">
                                    <td style="padding: 10px 6px; font-weight: 600;">{{ $network->id }}</td>
                                    <td style="padding: 10px 6px; font-weight: 500;">{{ $network->name }}</td>
                                    <td style="padding: 10px 6px;">
                                        @if($network->icon)
                                            <i class="bi {{ $network->icon }}" style="font-size: 1.5rem;"></i>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td style="padding: 10px 6px; word-break: break-all;">
                                        {{ $network->url ? Str::limit($network->url, 30) : '—' }}
                                    </td>
                                    <td style="padding: 10px 6px;">{{ $network->order }}</td>
                                    <td style="padding: 10px 6px;">
                                        @if($network->is_active)
                                            <span class="badge badge-abierto">
                                                <i class="bi bi-check-circle me-1"></i> Activo
                                            </span>
                                        @else
                                            <span class="badge badge-cerrado">
                                                <i class="bi bi-x-circle me-1"></i> Inactivo
                                            </span>
                                        @endif
                                    </td>
                                    <td style="padding: 10px 6px; text-align: center; vertical-align: middle;">
                                        <div class="d-flex justify-content-center gap-2" style="flex-wrap: nowrap;">
                                            <a href="{{ route('admin.social-networks.edit', $network) }}" class="btn-editar">
                                                <i class="bi bi-pencil-square me-1"></i> Editar
                                            </a>
                                            <form action="{{ route('admin.social-networks.destroy', $network) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-eliminar" onclick="return confirm('¿Eliminar esta red social?')">
                                                    <i class="bi bi-trash me-1"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <i class="bi bi-share" style="font-size: 3rem; color: #ccc;"></i>
                                        <p class="text-muted mt-3">No hay redes sociales registradas.</p>
                                        <a href="{{ route('admin.social-networks.create') }}" class="btn-crear">
                                            <i class="bi bi-plus-circle me-1"></i> Agregar primera red
                                        </a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer" style="background-color: #f8f9fa; border-top: 1px solid #e9ecef; padding: 12px 20px; text-align: center; border-radius: 0 0 16px 16px;">
                    <span class="text-muted">
                        Total: <strong style="color: #1a3a6b;">{{ $networks->count() }}</strong> redes sociales
                    </span>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection