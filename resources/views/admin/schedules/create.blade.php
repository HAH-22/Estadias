@extends('layouts.app')

@section('content')
<main class="contenido-principal" style="display: flex; justify-content: center; align-items: center; min-height: 100vh; width: 100%; padding: 20px;">
    <div style="width: 100%; max-width: 600px;">
        <!-- Encabezado -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="background-color: #1a3a6b; width: 50px; height: 50px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                <i class="bi bi-plus-circle" style="color: white; font-size: 24px;"></i>
            </div>
            <h2 style="color: #1a3a6b; font-weight: 700; font-size: 1.8rem;">Crear Horario</h2>
            <p style="color: #5a6b7c; font-size: 1rem;">Registra un nuevo horario por día</p>
        </div>

        <div class="card shadow-lg border-0" style="border-radius: 16px; overflow: hidden; width: 100%;">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.schedules.store') }}" style="display: flex; flex-direction: column; align-items: center;">
                    @csrf

                    <!-- Día -->
                    <div class="mb-3" style="width: 100%; max-width: 400px;">
                        <label for="day" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-calendar me-1"></i> Día
                        </label>
                        <select name="day" id="day" class="form-control" required style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                            <option value="">Selecciona un día</option>
                            <option value="Lunes">Lunes</option>
                            <option value="Martes">Martes</option>
                            <option value="Miércoles">Miércoles</option>
                            <option value="Jueves">Jueves</option>
                            <option value="Viernes">Viernes</option>
                            <option value="Sábado">Sábado</option>
                            <option value="Domingo">Domingo</option>
                        </select>
                        @error('day') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Apertura -->
                    <div class="mb-3" style="width: 100%; max-width: 400px;">
                        <label for="open_time" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-hourglass-top me-1"></i> Hora de Apertura
                        </label>
                        <input type="time" name="open_time" id="open_time" class="form-control" value="{{ old('open_time') }}" style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('open_time') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Cierre -->
                    <div class="mb-3" style="width: 100%; max-width: 400px;">
                        <label for="close_time" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-hourglass-bottom me-1"></i> Hora de Cierre
                        </label>
                        <input type="time" name="close_time" id="close_time" class="form-control" value="{{ old('close_time') }}" style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('close_time') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Cerrado -->
                    <div class="mb-4" style="width: 100%; max-width: 400px; text-align: left;">
                        <div class="form-check">
                            <input type="checkbox" name="is_closed" id="is_closed" class="form-check-input" value="1" {{ old('is_closed') ? 'checked' : '' }} style="border-radius: 4px; border-color: #ced4da; width: 18px; height: 18px;">
                            <label class="form-check-label" for="is_closed" style="color: #1a3a6b; font-weight: 500;">
                                <i class="bi bi-x-circle me-1"></i> Cerrado
                            </label>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="d-flex justify-content-center gap-3 mt-2">
                        <button type="submit" class="btn" style="background-color: #1a3a6b; color: white; padding: 10px 35px; border-radius: 50px; border: none; font-weight: 600; font-size: 0.95rem; box-shadow: 0 4px 12px rgba(26, 58, 107, 0.3);">
                            <i class="bi bi-check-circle me-1"></i> Guardar
                        </button>
                        <a href="{{ route('admin.schedules.index') }}" class="btn" style="background-color: #6c757d; color: white; padding: 10px 35px; border-radius: 50px; border: none; font-weight: 600; font-size: 0.95rem; text-decoration: none;">
                            <i class="bi bi-x-circle me-1"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
