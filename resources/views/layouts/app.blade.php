<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap Icons (CDN) -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <!-- Scripts (Vite) -->
        @vite(['resources/css/app.css', 'resources/css/styles.css', 'resources/js/app.js'])
    </head>
    @include('components.chatbot')
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>


            <!-- FOOTER -->
            <footer class="bg-gray-900 text-white pt-12 pb-4 mt-12">
                @php 
                    $config = App\Models\GymConfig::first();
                    $socialNetworks = App\Models\SocialNetwork::where('is_active', true)->orderBy('order')->get();
                @endphp
                <div class="container mx-auto px-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        
                        <!-- Columna 1: Nombre y descripción -->
                        <div>
                            <h3 class="text-2xl font-bold mb-2">
                                SITE FITNESS GYM
                            </h3>
                            <p class="text-gray-400 text-sm mb-4">
                                <span class="font-semibold text-white">SFG</span> — Tu mejor opción para entrenar.
                            </p>
                            <p class="text-gray-500 text-xs">© {{ date('Y') }} Site Fitness GYM. Todos los derechos reservados.</p>
                        </div>

                        <!-- Columna 2: Redes Sociales -->
                        <div>
                            <h4 class="text-lg font-semibold mb-3">Redes Sociales</h4>
                            <div class="flex flex-col space-y-2">
                                @forelse($socialNetworks as $network)
                                    @if($network->is_active && $network->url)
                                        <a href="{{ $network->url }}" target="_blank" class="text-gray-400 hover:text-white transition flex items-center gap-2">
                                            @if($network->icon)
                                                <i class="bi {{ $network->icon }} text-xl"></i>
                                            @endif
                                            {{ $network->name }}
                                        </a>
                                    @endif
                                @empty
                                    <p class="text-gray-500 text-sm">Próximamente en redes sociales</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Columna 3: Contactos -->
                        <div>
                            <h4 class="text-lg font-semibold mb-3">Contactos</h4>
                            <div class="space-y-2 text-gray-400">
                                <p class="flex items-center gap-2">
                                    <i class="bi bi-telephone"></i>
                                    {{ $config->phone ?? '636-123-45-67' }}
                                </p>
                                <p class="flex items-center gap-2">
                                    <i class="bi bi-envelope"></i>
                                    {{ $config->email ?? 'sitefitnessgym@gmail.com' }}
                                </p>
                            </div>
                        </div>

                    </div>

                    <!-- Línea divisoria y copyright (visible en móvil también) -->
                    <div class="border-t border-gray-800 mt-8 pt-4 text-center text-gray-500 text-sm">
                        © {{ date('Y') }} Site Fitness GYM. Todos los derechos reservados.
                    </div>
                </div>
            </footer>

        </div>
    </body>
</html>