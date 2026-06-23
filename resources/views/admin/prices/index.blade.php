@extends('layouts.app')

@section('content')
<main class="contenido-principal" style="display: flex; justify-content: center; align-items: center; min-height: 100vh; width: 100%; padding: 20px;">
    <div style="width: 100%; max-width: 1000px;">
        <!-- Encabezado -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="background-color: #1a3a6b; width: 50px; height: 50px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                <i class="bi bi-currency-dollar" style="color: white; font-size: 24px;"></i>
            </div>
            <h2 style="color: #1a3a6b; font-weight: 700; font-size: 1.8rem;">Lista de Precios</h2>
            <p style="color: #5a6b7c; font-size: 1rem;">Administra los precios del gimnasio</p>
        </div>

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('admin.prices.create') }}" class="btn-crear">
                <i class="bi bi-plus-circle me-1"></i> Nuevo Precio
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
                                    <th style="min-width: 150px; padding: 12px 6px;">Nombre</th>
                                    <th style="min-width: 150px; padding: 12px 6px;">Precio</th>
                                    <th style="width: 100px; padding: 12px 6px;">Orden</th>
                                    <th style="width: 120px; padding: 12px 6px;">Estado</th>
                                    <th style="width: 220px; padding: 12px 6px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($prices as $price)
                                <tr style="text-align: center; vertical-align: middle;">
                                    <td style="padding: 10px 6px; font-weight: 600;">{{ $price->id }}</td>
                                    <td style="padding: 10px 6px; font-weight: 500;">{{ $price->name }}</td>
                                    <td style="padding: 10px 6px; font-weight: 600; color: #28a745;">${{ number_format($price->price, 2) }}</td>
                                    <td style="padding: 10px 6px;">{{ $price->order }}</td>
                                    <td style="padding: 10px 6px;">
                                        @if($price->is_active)
                                            <span class="badge-abierto">Activo</span>
                                        @else
                                            <span class="badge-cerrado">Inactivo</span>
                                        @endif
                                    </td>
                                    <td style="padding: 10px 6px; text-align: center; vertical-align: middle;">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.prices.edit', $price) }}" class="btn-editar">
                                                <i class="bi bi-pencil-square me-1"></i> Editar
                                            </a>
                                            <form action="{{ route('admin.prices.destroy', $price) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-eliminar" onclick="return confirm('¿Eliminar este precio?')">
                                                    <i class="bi bi-trash me-1"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <i class="bi bi-currency-dollar" style="font-size: 3rem; color: #ccc;"></i>
                                        <p class="text-muted mt-3">No hay precios registrados.</p>
                                        <a href="{{ route('admin.prices.create') }}" class="btn-crear">
                                            <i class="bi bi-plus-circle me-1"></i> Crear primer precio
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
                        Total: <strong style="color: #1a3a6b;">{{ $prices->count() }}</strong> precios
                    </span>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection