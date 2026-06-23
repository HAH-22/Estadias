@extends('layouts.app')

@section('content')
<main class="contenido-principal" style="display: flex; justify-content: center; align-items: center; min-height: 100vh; width: 100%; padding: 20px;">
    <div style="width: 100%; max-width: 900px;">
        <!-- Encabezado -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="background-color: #1a3a6b; width: 50px; height: 50px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                <i class="bi bi-person-gear" style="color: white; font-size: 24px;"></i>
            </div>
            <h2 style="color: #1a3a6b; font-weight: 700; font-size: 1.8rem;">Mis Datos</h2>
            <p style="color: #5a6b7c; font-size: 1rem;">Actualiza tu peso, altura y foto de perfil</p>
        </div>

        <!-- Mensajes de éxito/error -->
        @if(session('success'))
            <div class="alert alert-success" style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 12px 20px; border-radius: 8px; margin-bottom: 1rem;">
                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 12px 20px; border-radius: 8px; margin-bottom: 1rem;">
                <ul style="margin:0; padding-left:20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Tarjeta -->
        <div class="card shadow-lg border-0" style="border-radius: 16px; overflow: hidden; width: 100%;">
            <div class="card-body p-4">

                <!-- Datos actuales -->
                <div style="width: 100%; max-width: 500px; margin: 0 auto 1.5rem;">
                    <h4 style="color: #1a3a6b; font-weight: 600; text-align: left; border-bottom: 2px solid #e9ecef; padding-bottom: 0.5rem;">
                        <i class="bi bi-person me-2"></i> Mi información
                    </h4>
                </div>

                <!-- ===== FILA DE DATOS ===== -->
                <div class="row g-3 mb-4" style="width: 100%; max-width: 500px; margin: 0 auto;">
                    <!-- Peso -->
                    <div class="col-6">
                        <div style="background-color: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                            <p style="margin:0; color: #6c757d; font-size: 0.85rem;">Peso</p>
                            <p style="margin:0; font-size: 1.2rem; font-weight: 600; color: #1a3a6b;">
                                {{ $user->weight ? $user->weight . ' kg' : '—' }}
                            </p>
                        </div>
                    </div>
                    <!-- Altura -->
                    <div class="col-6">
                        <div style="background-color: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                            <p style="margin:0; color: #6c757d; font-size: 0.85rem;">Altura</p>
                            <p style="margin:0; font-size: 1.2rem; font-weight: 600; color: #1a3a6b;">
                                {{ $user->height ? $user->height . ' cm' : '—' }}
                            </p>
                        </div>
                    </div>
                    <!-- Plan -->
                    <div class="col-6">
                        <div style="background-color: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                            <p style="margin:0; color: #6c757d; font-size: 0.85rem;">Plan</p>
                            <p style="margin:0; font-size: 1.2rem; font-weight: 600; color: #1a3a6b;">
                                {{ $user->plan->name ?? 'Sin plan' }}
                            </p>
                        </div>
                    </div>
                    <!-- Membresía con estado -->
                    <div class="col-6">
                        <div style="background-color: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                            <p style="margin:0; color: #6c757d; font-size: 0.85rem;">Membresía</p>
                            <p style="margin:0; font-size: 1rem; font-weight: 600; color: #1a3a6b;">
                                {{ $user->membership_expires_at ? \Carbon\Carbon::parse($user->membership_expires_at)->format('d/m/Y') : '—' }}
                            </p>
                            <!-- ✅ ESTADO DE MEMBRESÍA CON BADGE -->
                            @php 
                                $status = $user->membership_status ?? ['text' => 'Sin membresía', 'color' => 'secondary', 'icon' => 'bi-clock'];
                            @endphp
                            <span style="display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 500; color: white; background-color: 
                                @if($status['color'] == 'success') #28a745
                                @elseif($status['color'] == 'warning') #ffc107
                                @elseif($status['color'] == 'danger') #dc3545
                                @else #6c757d @endif;
                                margin-top: 4px;">
                                <i class="bi {{ $status['icon'] }}" style="margin-right: 4px;"></i> {{ $status['text'] }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- ===== FORMULARIO ===== -->
                <form method="POST" action="{{ route('user-data.update') }}" enctype="multipart/form-data" style="display: flex; flex-direction: column; align-items: center;">
                    @csrf
                    @method('PUT')

                    <!-- Foto -->
                    <div style="width: 100%; max-width: 500px; margin-bottom: 1rem; text-align: center;">
                        <label class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-image me-1"></i> Foto de perfil
                        </label>
                        <div style="display: flex; justify-content: center; align-items: center; gap: 1rem;">
                            <div style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; border: 3px solid #1a3a6b; background-color: #e9ecef;">
                                @if($user->profile_photo)
                                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Foto" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #6c757d; font-size: 2rem; font-weight: bold;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <input type="file" name="profile_photo" id="profile_photo" accept="image/*" style="flex:1;">
                        </div>
                        @error('profile_photo') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Peso -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="weight" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-weight-scale me-1"></i> Peso (kg)
                        </label>
                        <input type="number" step="0.01" name="weight" id="weight" class="form-control" value="{{ old('weight', $user->weight) }}"
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('weight') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Altura -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="height" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-rulers me-1"></i> Altura (cm)
                        </label>
                        <input type="number" step="0.01" name="height" id="height" class="form-control" value="{{ old('height', $user->height) }}"
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('height') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Botones -->
                    <div class="d-flex justify-content-center gap-3 mt-3">
                        <button type="submit" class="btn" style="background-color: #1a3a6b; color: white; padding: 10px 35px; border-radius: 50px; border: none; font-weight: 600; font-size: 0.95rem; box-shadow: 0 4px 12px rgba(26, 58, 107, 0.3);">
                            <i class="bi bi-check-circle me-1"></i> Guardar cambios
                        </button>
                        <a href="{{ route('dashboard') }}" class="btn" style="background-color: #6c757d; color: white; padding: 10px 35px; border-radius: 50px; border: none; font-weight: 600; font-size: 0.95rem; text-decoration: none;">
                            <i class="bi bi-x-circle me-1"></i> Cancelar
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</main>
@endsection

<style>
    .btn {
        transition: all 0.2s;
    }
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }
    .form-control:focus {
        border-color: #1a3a6b;
        box-shadow: 0 0 0 0.2rem rgba(26, 58, 107, 0.15);
        outline: none;
    }
    .form-control:hover {
        border-color: #1a3a6b;
    }
    .form-control {
        transition: all 0.3s;
        width: 100% !important;
    }
    .contenido-principal {
        width: 100%;
        margin: 0;
    }
    .text-muted {
        font-size: 0.8rem;
        color: #6c757d;
    }
</style>