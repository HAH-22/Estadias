@extends('layouts.app')

@section('content')
<!-- ===== CARRUSEL DINÁMICO ===== -->
@if(isset($slides) && $slides->count())
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach($slides as $key => $slide)
        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
            <img src="{{ asset('storage/' . $slide->image) }}" 
                 class="d-block w-100 img-fluid" 
                 alt="{{ $slide->title }}">
            @if($slide->title || $slide->subtitle)
            <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.5); padding: 15px 20px; border-radius: 8px;">
                <h3>{{ $slide->title }}</h3>
                <p>{{ $slide->subtitle }}</p>
                @if($slide->link)
                    <a href="{{ $slide->link }}" class="btn btn-primary btn-sm">Ver más</a>
                @endif
            </div>
            @endif
        </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
</div>
@else
    <div class="alert alert-warning text-center">No hay imágenes para mostrar en el carrusel.</div>
@endif

<section class="bg-[#1a3a6b] text-white py-20">
    <div class="container mx-auto text-center">
        <h1 class="text-5xl font-bold">{{ $config->hero_title ?? 'Entrena duro, vive fuerte' }}</h1>
        <p class="text-xl mt-4">{!! $config->hero_subtitle ?? 'Encuentra las mejores instalaciones aquí, <br> ¡ENTRENA CON NOSOTROS!' !!}
    </div>
</section>

<!-- Servicios -->
<section class="py-16 bg-gray-100">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Nuestros Servicios</h2>
        <div class="grid md:grid-cols-3 gap-8">
            @forelse($services as $service)
                @if($service->is_active)
                    <div class="bg-white rounded shadow p-6 text-center">
                        @if($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" 
                                 class="h-48 w-auto mx-auto mb-4 object-contain">
                        @endif
                        <h3 class="text-2xl font-bold">{{ $service->title }}</h3>
                        <p class="text-gray-600 mt-2">{{ $service->description }}</p>
                    </div>
                @endif
            @empty
                <p class="text-gray-500 col-span-3 text-center">No hay servicios configurados.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- Planes de membresía -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Elige tu plan ideal y comienza tu cambio</h2>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($plans as $plan)
            <div class="bg-white rounded shadow p-6 text-center">
                @if($plan->image)
                    <img src="{{ asset('storage/' . $plan->image) }}" class="h-20 mx-auto mb-4">
                @endif
                <h3 class="text-2xl font-bold">{{ $plan->name }}</h3>
                <p class="text-gray-600 mt-2">{{ $plan->description ?? 'Entrena a tu ritmo' }}</p>
                <p class="text-3xl font-bold text-blue-600 mt-4">${{ number_format($plan->price, 2) }}</p>
                <p class="text-sm text-gray-500">Inscripción: ${{ number_format($plan->inscription_fee, 2) }}</p>
                <ul class="mt-4 text-sm text-center">
                    @foreach(explode("\n", $plan->features ?? '') as $feature)
                        <li>✓ {{ $feature }}</li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Entrenadores -->
@if($trainers->count())
<section class="py-16 bg-gray-100">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Nuestros Entrenadores</h2>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($trainers as $trainer)
            <div class="bg-white rounded shadow p-6 text-center">  <!-- Aumenté el padding a p-6 -->
                <!-- Foto -->
                @if($trainer->photo)
                    <img src="{{ asset('storage/' . $trainer->photo) }}" class="w-32 h-32 rounded-full mx-auto object-cover">
                @else
                    <img src="{{ asset('images/default-avatar.png') }}" class="w-32 h-32 rounded-full mx-auto object-cover">
                @endif
                
                <!-- Nombre -->
                <h3 class="text-xl font-bold mt-4">{{ $trainer->name }}</h3>
                
                <!-- Especialidad -->
                <p class="text-gray-600">{{ $trainer->specialty }}</p>
                
                <!-- BIOGRAFÍA COMPLETA -->
                @if($trainer->bio)
                    <div class="mt-3 text-sm text-gray-600 text-left">  <!-- Alineación izquierda para mejor lectura -->
                        {!! nl2br(e($trainer->bio)) !!}
                    </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Lista de Precios -->
@if($prices->count())
<section class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Nuestros Precios</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($prices as $price)
                @if($price->is_active)
                    <div class="bg-white rounded-lg shadow p-4 text-center border border-gray-200 hover:shadow-lg transition duration-300">
                        <h4 class="text-lg font-semibold text-gray-800">{{ $price->name }}</h4>
                        <p class="text-2xl font-bold text-blue-600">${{ number_format($price->price, 2) }}</p>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Dirección y ubicación -->
<section class="py-16">
    <div class="container mx-auto px-4 grid md:grid-cols-2 gap-8">
        <div>
            <h3 class="text-2xl font-bold">Dirección y ubicación</h3>
            <p class="mt-2">{{ $config->address ?? 'Constitución 2625 col. centro...' }}</p>
            
            <!-- Mini mapa con coordenadas -->
            <div class="mt-4" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                <iframe 
                    src="https://maps.google.com/maps?q={{ $config->latitude ?? '30.430891' }},{{ $config->longitude ?? '-107.914009' }}&z=16&output=embed" 
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>

            <!-- Botón para abrir en Google Maps -->
            <a href="https://www.google.com/maps/search/?api=1&query={{ $config->latitude ?? '30.430891' }},{{ $config->longitude ?? '-107.914009' }}" 
               target="_blank" 
               class="mt-3 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition text-sm">
                <i class="bi bi-box-arrow-up-right me-1"></i> Abrir en Google Maps
            </a>
        </div>
        <div>
            <h3 class="text-2xl font-bold">Horarios</h3>
            <ul class="mt-2 space-y-1">
                @foreach($schedules as $schedule)
                    <li>
                        <strong>{{ $schedule->day }}:</strong>
                        @if($schedule->is_closed)
                            <span class="text-red-600">Cerrado</span>
                        @else
                            {{ \Carbon\Carbon::parse($schedule->open_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->close_time)->format('H:i') }} hrs
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
@endsection
