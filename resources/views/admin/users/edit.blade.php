@extends('layouts.app')

@section('content')
<main class="contenido-principal" style="display: flex; justify-content: center; align-items: center; min-height: 100vh; width: 100%; padding: 20px;">
    <div style="width: 100%; max-width: 900px;">
        <!-- Encabezado -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="background-color: #1a3a6b; width: 50px; height: 50px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                <i class="bi bi-pencil-square" style="color: white; font-size: 24px;"></i>
            </div>
            <h2 style="color: #1a3a6b; font-weight: 700; font-size: 1.8rem;">Editar Usuario</h2>
            <p style="color: #5a6b7c; font-size: 1rem;">Modifica los datos del usuario en el sistema</p>
        </div>

        <!-- Tarjeta -->
        <div class="card shadow-lg border-0" style="border-radius: 16px; overflow: hidden; width: 100%;">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.users.update', $user) }}" 
                      style="display: flex; flex-direction: column; align-items: center;">
                    @csrf
                    @method('PUT')

                    <!-- Nombre -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="name" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-person me-1"></i> Nombre
                        </label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="email" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-envelope me-1"></i> Correo electrónico
                        </label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Contraseña -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="password" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-lock me-1"></i> Contraseña (dejar vacío para no cambiar)
                        </label>
                        <input type="password" name="password" id="password" class="form-control"
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="password_confirmation" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-shield-lock me-1"></i> Confirmar Contraseña
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                    </div>

                    <!-- Checkbox Administrador -->
                    <div class="mb-4" style="width: 100%; max-width: 500px; text-align: left;">
                        <div class="form-check">
                            <input type="checkbox" name="is_admin" id="is_admin" class="form-check-input" value="1" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}
                                   style="border-radius: 4px; border-color: #ced4da; width: 18px; height: 18px; margin-top: 0.2rem;">
                            <label class="form-check-label" for="is_admin" style="color: #1a3a6b; font-weight: 500;">
                                ¿Administrador?
                            </label>
                        </div>
                    </div>

                    <!-- Plan -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="plan_id" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-card-list me-1"></i> Plan de membresía
                        </label>
                        <select name="plan_id" id="plan_id" class="form-control" style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                            <option value="">Sin plan</option>
                            @foreach($plans as $plan)
                                <option value="{{ $plan->id }}" {{ old('plan_id', $user->plan_id) == $plan->id ? 'selected' : '' }}>
                                    {{ $plan->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('plan_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Fecha de expiración de membresía -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="membership_expires_at" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-calendar-event me-1"></i> Membresía válida hasta
                        </label>
                        <input type="date" name="membership_expires_at" id="membership_expires_at" class="form-control"
                               value="{{ old('membership_expires_at', $user->membership_expires_at ? \Carbon\Carbon::parse($user->membership_expires_at)->format('Y-m-d') : '') }}"
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('membership_expires_at') <span class="text-danger">{{ $message }}</span> @enderror
                        <!-- Botones de renovación rápida -->
                        <div class="mt-2">
                            <button type="button" class="btn btn-sm" style="background-color: #28a745; color: white; border: none; padding: 6px 15px; border-radius: 50px;"
                                    onclick="document.getElementById('membership_expires_at').value = '{{ now()->addDays(30)->format('Y-m-d') }}'">
                                <i class="bi bi-plus-circle me-1"></i> +30 días
                            </button>
                            <button type="button" class="btn btn-sm" style="background-color: #dc3545; color: white; border: none; padding: 6px 15px; border-radius: 50px;"
                                    onclick="document.getElementById('membership_expires_at').value = ''">
                                <i class="bi bi-trash me-1"></i> Quitar
                            </button>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="d-flex justify-content-center gap-3 mt-2">
                        <button type="submit" class="btn" style="background-color: #1a3a6b; color: white; padding: 10px 35px; border-radius: 50px; border: none; font-weight: 600; font-size: 0.95rem; box-shadow: 0 4px 12px rgba(26, 58, 107, 0.3);">
                            <i class="bi bi-check-circle me-1"></i> Actualizar
                        </button>
                        <a href="{{ route('admin.users.index') }}" class="btn" style="background-color: #6c757d; color: white; padding: 10px 35px; border-radius: 50px; border: none; font-weight: 600; font-size: 0.95rem; text-decoration: none;">
                            <i class="bi bi-x-circle me-1"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
