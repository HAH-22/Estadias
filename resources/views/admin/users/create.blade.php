@extends('layouts.app')

@section('content')
<main class="contenido-principal" style="display: flex; justify-content: center; align-items: center; min-height: 100vh; width: 100%; padding: 20px;">
    <div style="width: 100%; max-width: 900px;">
        <!-- Encabezado -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="background-color: #1a3a6b; width: 50px; height: 50px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                <i class="bi bi-person-plus" style="color: white; font-size: 24px;"></i>
            </div>
            <h2 style="color: #1a3a6b; font-weight: 700; font-size: 1.8rem;">Crear Usuario</h2>
            <p style="color: #5a6b7c; font-size: 1rem;">Registra un nuevo usuario en el sistema</p>
        </div>

        <!-- Tarjeta -->
        <div class="card shadow-lg border-0" style="border-radius: 16px; overflow: hidden; width: 100%;">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.users.store') }}" 
                      style="display: flex; flex-direction: column; align-items: center;">
                    @csrf

                    <!-- Nombre -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="name" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-person me-1"></i> Nombre
                        </label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="email" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-envelope me-1"></i> Correo electrónico
                        </label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Contraseña -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="password" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-lock me-1"></i> Contraseña
                        </label>
                        <input type="password" name="password" id="password" class="form-control" required
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="password_confirmation" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-shield-lock me-1"></i> Confirmar Contraseña
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                    </div>

                    <!-- Checkbox Administrador -->
                    <div class="mb-4" style="width: 100%; max-width: 500px; text-align: left;">
                        <div class="form-check">
                            <input type="checkbox" name="is_admin" id="is_admin" class="form-check-input" value="1" {{ old('is_admin') ? 'checked' : '' }}
                                   style="border-radius: 4px; border-color: #ced4da; width: 18px; height: 18px; margin-top: 0.2rem;">
                            <label class="form-check-label" for="is_admin" style="color: #1a3a6b; font-weight: 500;">
                                ¿Administrador?
                            </label>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="d-flex justify-content-center gap-3 mt-2">
                        <button type="submit" class="btn" style="background-color: #1a3a6b; color: white; padding: 10px 35px; border-radius: 50px; border: none; font-weight: 600; font-size: 0.95rem; box-shadow: 0 4px 12px rgba(26, 58, 107, 0.3);">
                            <i class="bi bi-check-circle me-1"></i> Guardar
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
