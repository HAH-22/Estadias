@extends('layouts.app')

@section('content')
<main class="contenido-principal" style="display: flex; justify-content: center; align-items: center; min-height: 100vh; width: 100%; padding: 20px;">
    <div style="width: 100%; max-width: 900px;">
        <!-- Encabezado -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="background-color: #1a3a6b; width: 50px; height: 50px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                <i class="bi bi-gear" style="color: white; font-size: 24px;"></i>
            </div>
            <h2 style="color: #1a3a6b; font-weight: 700; font-size: 1.8rem;">Configuración del Gimnasio</h2>
            <p style="color: #5a6b7c; font-size: 1rem;">Actualiza la información de contacto, dirección y horarios</p>
        </div>

        <!-- BLOQUE DE MENSAJES -->
        @if(session('success'))
            <div class="alert alert-success" style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 12px 20px; border-radius: 8px; margin-bottom: 1rem;">
                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 12px 20px; border-radius: 8px; margin-bottom: 1rem;">
                <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
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
                <form method="POST" action="{{ route('admin.gym-config.update') }}" enctype="multipart/form-data"
                      style="display: flex; flex-direction: column; align-items: center;">
                    @csrf
                    @method('PUT')

                    <!-- Datos del Gimnasio -->
                    <div style="width: 100%; max-width: 500px; margin-bottom: 1.5rem;">
                        <h4 style="color: #1a3a6b; font-weight: 600; text-align: left; border-bottom: 2px solid #e9ecef; padding-bottom: 0.5rem;">
                            <i class="bi bi-building me-2"></i> Datos del Gimnasio
                        </h4>
                    </div>

                    <!-- Dirección -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="address" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-geo-alt me-1"></i> Dirección
                        </label>
                        <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $config->address ?? '') }}"
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Latitud y Longitud -->
                    <div class="row g-2 mb-3" style="width: 100%; max-width: 500px;">
                        <div class="col-6">
                            <label for="latitude" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                                <i class="bi bi-geo me-1"></i> Latitud
                            </label>
                            <input type="text" name="latitude" id="latitude" class="form-control" 
                                   value="{{ old('latitude', $config->latitude ?? '') }}"
                                   placeholder="Ej: 30.430891"
                                   style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                            @error('latitude') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-6">
                            <label for="longitude" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                                <i class="bi bi-geo me-1"></i> Longitud
                            </label>
                            <input type="text" name="longitude" id="longitude" class="form-control" 
                                   value="{{ old('longitude', $config->longitude ?? '') }}"
                                   placeholder="Ej: -107.914009"
                                   style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                            @error('longitude') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <small class="text-muted" style="padding-left: 12px;">Puedes obtener las coordenadas desde <a href="https://www.google.com/maps" target="_blank">Google Maps</a> (clic derecho → "¿Qué hay aquí?")</small>
                    </div>

                    <!-- Teléfono -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="phone" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-telephone me-1"></i> Teléfono
                        </label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $config->phone ?? '') }}"
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Correo electrónico -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="email" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-envelope me-1"></i> Correo electrónico
                        </label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $config->email ?? '') }}"
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Hero -->
                    <div style="width: 100%; max-width: 500px; margin-bottom: 1.5rem;">
                        <h4 style="color: #1a3a6b; font-weight: 600; text-align: left; border-bottom: 2px solid #e9ecef; padding-bottom: 0.5rem;">
                            <i class="bi bi-megaphone me-2"></i> Texto del Hero
                        </h4>
                    </div>

                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="hero_title" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-type me-1"></i> Título principal
                        </label>
                        <input type="text" name="hero_title" id="hero_title" class="form-control" 
                               value="{{ old('hero_title', $config->hero_title ?? 'Entrena duro, vive fuerte') }}"
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('hero_title') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="hero_subtitle" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-text-paragraph me-1"></i> Subtítulo
                        </label>
                        <input type="text" name="hero_subtitle" id="hero_subtitle" class="form-control" 
                               value="{{ old('hero_subtitle', $config->hero_subtitle ?? 'Encuentra las mejores instalaciones aquí, ¡ENTRENA CON NOSOTROS!') }}"
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 16px; font-size: 1rem; width: 100%;">
                        @error('hero_subtitle') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Imágenes -->
                    <div style="width: 100%; max-width: 500px; margin-top: 1rem; margin-bottom: 1rem;">
                        <h4 style="color: #1a3a6b; font-weight: 600; text-align: left; border-bottom: 2px solid #e9ecef; padding-bottom: 0.5rem;">
                            <i class="bi bi-images me-2"></i> Imágenes
                        </h4>
                    </div>

                    <!-- Logo -->
                    <div class="mb-3" style="width: 100%; max-width: 500px;">
                        <label for="logo" class="form-label" style="color: #1a3a6b; font-weight: 600; font-size: 0.9rem; display: block; text-align: left;">
                            <i class="bi bi-image me-1"></i> Logo
                        </label>
                        @if($config && $config->logo)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $config->logo) }}" alt="Logo actual" style="max-height: 80px; border-radius: 8px;">
                            </div>
                        @endif
                        <input type="file" name="logo" id="logo" class="form-control" accept="image/*"
                               style="border-radius: 8px; border: 2px solid #e9ecef; padding: 10px 14px; font-size: 1rem; width: 100%;">
                        <small class="text-muted">Formatos: JPG, PNG, GIF. Máx 2MB.</small>
                        @error('logo') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Botones -->
                    <div class="d-flex justify-content-center gap-3 mt-3">
                        <button type="submit" class="btn" style="background-color: #1a3a6b; color: white; padding: 10px 35px; border-radius: 50px; border: none; font-weight: 600; font-size: 0.95rem; box-shadow: 0 4px 12px rgba(26, 58, 107, 0.3);">
                            <i class="bi bi-check-circle me-1"></i> Guardar
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
