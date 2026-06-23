@extends('layouts.app')

@section('content')
<main class="contenido-principal" style="display: flex; justify-content: center; align-items: center; min-height: 100vh; width: 100%; padding: 20px;">
    <div style="width: 100%; max-width: 1200px;">
        <!-- Encabezado -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="background-color: #1a3a6b; width: 50px; height: 50px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                <i class="bi bi-people" style="color: white; font-size: 24px;"></i>
            </div>
            <h2 style="color: #1a3a6b; font-weight: 700; font-size: 1.8rem;">Gestión de Usuarios</h2>
            <p style="color: #5a6b7c; font-size: 1rem;">Administra todos los usuarios registrados en el sistema</p>
        </div>

        <!-- Botón Nuevo Usuario -->
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('admin.users.create') }}" class="btn" style="background-color: #1a3a6b; color: white; padding: 10px 25px; border-radius: 50px; text-decoration: none; transition: 0.3s; font-weight: 500; box-shadow: 0 4px 12px rgba(26, 58, 107, 0.2);">
                <i class="bi bi-plus-circle me-1"></i> Nuevo Usuario
            </a>
        </div>

        <!-- Buscador -->
        <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
            <form method="GET" action="{{ route('admin.users.index') }}" class="d-flex flex-grow-1 gap-2" style="max-width: 700px;">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nombre, email, plan o rol..." class="form-control" style="border-radius: 50px; padding: 12px 24px; width: 100%; font-size: 1.05rem; border: 2px solid #ced4da; transition: all 0.3s;">
                <button type="submit" class="btn" style="background-color: #1a3a6b; color: white; border-radius: 50px; padding: 12px 28px; font-size: 1rem; white-space: nowrap;">
                    <i class="bi bi-search me-1"></i> Buscar
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.users.index') }}" class="btn" style="background-color: #6c757d; color: white; border-radius: 50px; padding: 12px 28px; font-size: 1rem; white-space: nowrap;">
                        <i class="bi bi-x-circle me-1"></i> Limpiar
                    </a>
                @endif
            </form>
            <div class="text-muted" style="color: #5a6b7c; white-space: nowrap; font-size: 0.95rem;">
                Mostrando <strong style="color: #1a3a6b;">{{ $users->count() }}</strong> usuarios
            </div>
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
                <div style="display: flex; justify-content: center;">
                    <div class="table-responsive" style="width: 100%; max-width: 100%;">
                        <table class="table table-hover mb-0" style="font-size: 14px; width: 100%; min-width: 768px;">
                            <thead style="background-color: #1a3a6b; color: white; text-align: center;">
                                <tr>
                                    <th style="width: 50px; padding: 12px 6px;">ID</th>
                                    <th style="min-width: 180px; padding: 12px 6px;">Nombre</th>
                                    <th style="min-width: 200px; padding: 12px 6px;">Email</th>
                                    <th style="min-width: 120px; padding: 12px 6px;">Plan</th>
                                    <th style="min-width: 140px; padding: 12px 6px;">Membresía</th>
                                    <th style="min-width: 150px; padding: 12px 6px;">Estado</th>
                                    <th style="width: 150px; padding: 12px 6px;">Rol</th>
                                    <th style="width: 220px; padding: 12px 6px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr style="text-align: center; vertical-align: middle;">
                                    <td style="padding: 10px 6px; font-weight: 600;">{{ $user->id }}</td>
                                    <td style="padding: 10px 6px;">
                                        <div class="d-flex align-items-center justify-content-center">
                                            @if($user->profile_photo)
                                                <img src="{{ asset('storage/' . $user->profile_photo) }}" 
                                                     alt="Foto de perfil" 
                                                     style="width: 36px; height: 36px; border-radius: 50%; object-fit: cover; border: 2px solid #e9ecef; margin-right: 8px;">
                                            @else
                                                <div class="avatar-inicial me-2" style="background-color: {{ $user->is_admin ? '#1a3a6b' : '#8a9baa' }}; width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 14px; border: 2px solid #e9ecef;">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                            @endif
                                            <span style="font-weight: 500;">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td style="padding: 10px 6px; color: #5a6b7c;">{{ $user->email }}</td>
                                    <td style="padding: 10px 6px;">{{ $user->plan->name ?? '—' }}</td>
                                    <td style="padding: 10px 6px;">
                                        {{ $user->membership_expires_at ? \Carbon\Carbon::parse($user->membership_expires_at)->format('d/m/Y') : '—' }}
                                    </td>
                                    <td style="padding: 10px 6px;">
                                        @php $status = $user->membership_status; @endphp
                                        <span class="badge" style="background-color: 
                                            @if($status['color'] == 'success') #28a745
                                            @elseif($status['color'] == 'warning') #ffc107
                                            @elseif($status['color'] == 'danger') #dc3545
                                            @else #6c757d @endif;
                                            color: white; padding: 5px 14px; border-radius: 50px; font-weight: 500; font-size: 0.8rem;">
                                            <i class="bi {{ $status['icon'] }} me-1"></i> {{ $status['text'] }}
                                        </span>
                                    </td>
                                    <td style="padding: 10px 6px;">
                                        @if($user->is_admin)
                                            <span class="badge" style="background-color: #1a3a6b; color: white; padding: 5px 14px; border-radius: 50px; font-weight: 500; font-size: 0.8rem;">
                                                <i class="bi bi-shield-check me-1"></i> Administrador
                                            </span>
                                        @else
                                            <span class="badge" style="background-color: #8a9baa; color: white; padding: 5px 14px; border-radius: 50px; font-weight: 500; font-size: 0.8rem;">
                                                <i class="bi bi-person me-1"></i> Usuario
                                            </span>
                                        @endif
                                    </td>
                                    <td style="padding: 10px 6px; text-align: center; vertical-align: middle;">
                                        <div class="d-flex justify-content-center gap-2" style="flex-wrap: nowrap;">
                                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm" style="background-color: #1a3a6b; color: white; padding: 8px 18px; border-radius: 50px; text-decoration: none; transition: 0.3s; font-size: 0.85rem; font-weight: 500; white-space: nowrap;">
                                                <i class="bi bi-pencil-square me-1"></i> Editar
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm" style="background-color: #dc3545; color: white; padding: 8px 18px; border-radius: 50px; border: none; transition: 0.3s; font-size: 0.85rem; font-weight: 500; white-space: nowrap;" onclick="return confirm('¿Eliminar este usuario?')">
                                                    <i class="bi bi-trash me-1"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <i class="bi bi-people" style="font-size: 3rem; color: #ccc;"></i>
                                        <p class="text-muted mt-3" style="color: #5a6b7c;">
                                            @if(request('search'))
                                                No se encontraron usuarios que coincidan con "<strong>{{ request('search') }}</strong>".
                                            @else
                                                No hay usuarios registrados todavía.
                                            @endif
                                        </p>
                                        @if(request('search'))
                                            <a href="{{ route('admin.users.index') }}" class="btn" style="background-color: #1a3a6b; color: white; padding: 10px 25px; border-radius: 50px; text-decoration: none; transition: 0.3s; font-weight: 500; box-shadow: 0 4px 12px rgba(26, 58, 107, 0.2);">
                                                <i class="bi bi-arrow-left me-1"></i> Ver todos
                                            </a>
                                        @else
                                            <a href="{{ route('admin.users.create') }}" class="btn" style="background-color: #1a3a6b; color: white; padding: 10px 25px; border-radius: 50px; text-decoration: none; transition: 0.3s; font-weight: 500; box-shadow: 0 4px 12px rgba(26, 58, 107, 0.2);">
                                                <i class="bi bi-plus-circle me-1"></i> Crear primer usuario
                                            </a>
                                        @endif
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
                        Total: <strong style="color: #1a3a6b;">{{ $users->count() }}</strong> usuarios
                        <span class="mx-2">|</span>
                        <span style="color: #1a3a6b;">●</span> Administradores: <strong style="color: #1a3a6b;">{{ $users->where('is_admin', true)->count() }}</strong>
                        <span class="mx-2">|</span>
                        <span style="color: #8a9baa;">●</span> Usuarios: <strong style="color: #1a3a6b;">{{ $users->where('is_admin', false)->count() }}</strong>
                    </span>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection