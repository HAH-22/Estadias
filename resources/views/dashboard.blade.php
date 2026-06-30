@extends('layouts.app')

@section('content')
<div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- ========================================== -->
        <!-- TARJETA DE BIENVENIDA CON FOTO DE PERFIL    -->
        <!-- ========================================== -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 overflow-hidden shadow-md rounded-2xl border border-blue-100 mb-6 hover:shadow-lg transition duration-300">
            <div class="p-6 text-gray-900">
                <div class="flex items-center gap-4">
                    @if(Auth::user()->profile_photo)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" 
                             alt="Foto de perfil" 
                             class="w-16 h-16 rounded-full object-cover border-4 border-blue-500 shadow-md">
                    @else
                        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-2xl font-bold shadow-md">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">¡Bienvenido, {{ Auth::user()->name }}!</h3>
                        <p class="mt-1 text-gray-600">Desde aquí puedes ver el contenido del gimnasio.</p>
                        <p class="text-sm text-gray-500">
                            <i class="bi bi-envelope me-1 text-blue-500"></i> {{ Auth::user()->email }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- ESTADÍSTICAS BÁSICAS                       -->
        <!-- ========================================== -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 overflow-hidden shadow-md rounded-2xl border border-blue-200 hover:shadow-lg transition duration-300">
                <div class="p-6 text-center">
                    <p class="text-3xl font-bold text-blue-700">{{ \App\Models\User::count() }}</p>
                    <p class="text-gray-700 font-medium">👥 Miembros registrados</p>
                </div>
            </div>
            <div class="bg-gradient-to-br from-green-50 to-green-100 overflow-hidden shadow-md rounded-2xl border border-green-200 hover:shadow-lg transition duration-300">
                <div class="p-6 text-center">
                    <p class="text-3xl font-bold text-green-700">{{ \App\Models\Plan::count() ?? 0 }}</p>
                    <p class="text-gray-700 font-medium">📋 Planes activos</p>
                </div>
            </div>
            <div class="bg-gradient-to-br from-purple-50 to-purple-100 overflow-hidden shadow-md rounded-2xl border border-purple-200 hover:shadow-lg transition duration-300">
                <div class="p-6 text-center">
                    <p class="text-3xl font-bold text-purple-700">{{ \App\Models\Trainer::count() ?? 0 }}</p>
                    <p class="text-gray-700 font-medium">🏋️ Entrenadores</p>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- ESTADÍSTICAS ADICIONALES (solo admin)      -->
        <!-- ========================================== -->
        @if(Auth::user()->is_admin)
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-6"> <!-- 👈 CAMBIADO: 5 columnas -->
            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 overflow-hidden shadow-md rounded-2xl border border-yellow-200 hover:shadow-lg transition duration-300">
                <div class="p-6 text-center">
                    <p class="text-3xl font-bold text-yellow-700">{{ \App\Models\Service::where('is_active', true)->count() }}</p>
                    <p class="text-gray-700 font-medium">📦 Servicios activos</p>
                </div>
            </div>
            <div class="bg-gradient-to-br from-red-50 to-red-100 overflow-hidden shadow-md rounded-2xl border border-red-200 hover:shadow-lg transition duration-300">
                <div class="p-6 text-center">
                    <p class="text-3xl font-bold text-red-700">{{ \App\Models\Slide::where('is_active', true)->count() }}</p>
                    <p class="text-gray-700 font-medium">🖼️ Slides activos</p>
                </div>
            </div>
            <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 overflow-hidden shadow-md rounded-2xl border border-indigo-200 hover:shadow-lg transition duration-300">
                <div class="p-6 text-center">
                    <p class="text-3xl font-bold text-indigo-700">{{ \App\Models\Schedule::count() }}</p>
                    <p class="text-gray-700 font-medium">⏰ Horarios configurados</p>
                </div>
            </div>
            <div class="bg-gradient-to-br from-pink-50 to-pink-100 overflow-hidden shadow-md rounded-2xl border border-pink-200 hover:shadow-lg transition duration-300">
                <div class="p-6 text-center">
                    <p class="text-3xl font-bold text-pink-700">{{ \App\Models\SocialNetwork::where('is_active', true)->count() }}</p>
                    <p class="text-gray-700 font-medium">🌐 Redes sociales activas</p>
                </div>
            </div>
            <!-- 👇 NUEVA ESTADÍSTICA: PRECIOS ACTIVOS -->
            <div class="bg-gradient-to-br from-teal-50 to-teal-100 overflow-hidden shadow-md rounded-2xl border border-teal-200 hover:shadow-lg transition duration-300">
                <div class="p-6 text-center">
                    <p class="text-3xl font-bold text-teal-700">{{ \App\Models\Price::where('is_active', true)->count() }}</p>
                    <p class="text-gray-700 font-medium">💰 Precios activos</p>
                </div>
            </div>
        </div>
        @endif

        <!-- ========================================== -->
        <!-- ACTIVIDAD RECIENTE (solo admin)            -->
        <!-- ========================================== -->
        @if(Auth::user()->is_admin)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Últimos usuarios registrados -->
            <div class="bg-white overflow-hidden shadow-md rounded-2xl border border-gray-200 hover:shadow-lg transition duration-300">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                            <span class="text-2xl">👥</span> Últimos usuarios
                        </h4>
                        <span class="text-xs bg-blue-100 text-blue-800 px-3 py-1 rounded-full font-medium">
                            {{ \App\Models\User::count() }} total
                        </span>
                    </div>
                    <ul class="space-y-3">
                        @foreach(\App\Models\User::latest()->take(5)->get() as $user)
                            <li class="flex justify-between items-center py-2 border-0">
                                <div class="flex items-center gap-3">
                                    @if($user->profile_photo)
                                        <img src="{{ asset('storage/' . $user->profile_photo) }}" 
                                             alt="Foto" 
                                             class="w-8 h-8 rounded-full object-cover border-2 border-blue-300 shadow-sm">
                                    @else
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white text-xs font-bold shadow-sm">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <span class="font-medium text-gray-800">{{ $user->name }}</span>
                                    @if($user->is_admin)
                                        <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded-full font-medium">Admin</span>
                                    @endif
                                </div>
                                <span class="text-xs text-gray-400">
                                    {{ $user->created_at ? $user->created_at->diffForHumans() : '—' }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('admin.users.index') }}" class="mt-4 inline-flex items-center text-sm text-blue-600 hover:text-blue-800 font-medium">
                        Ver todos →
                    </a>
                </div>
            </div>

            <!-- Últimos planes creados -->
            <div class="bg-white overflow-hidden shadow-md rounded-2xl border border-gray-200 hover:shadow-lg transition duration-300">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                            <span class="text-2xl">📋</span> Últimos planes
                        </h4>
                        <span class="text-xs bg-green-100 text-green-800 px-3 py-1 rounded-full font-medium">
                            {{ \App\Models\Plan::count() }} total
                        </span>
                    </div>
                    <ul class="space-y-3">
                        @foreach(\App\Models\Plan::latest()->take(5)->get() as $plan)
                            <li class="flex justify-between items-center py-2 border-0">
                                <span class="font-medium text-gray-800">{{ $plan->name }}</span>
                                <span class="text-sm font-semibold text-green-600">${{ number_format($plan->price, 2) }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('admin.plans.index') }}" class="mt-4 inline-flex items-center text-sm text-blue-600 hover:text-blue-800 font-medium">
                        Ver todos →
                    </a>
                </div>
            </div>
        </div>
        @endif

        <!-- ========================================== -->
        <!-- ACCIONES DE ADMINISTRACIÓN (solo admin)    -->
        <!-- ========================================== -->
        @if(Auth::user()->is_admin)
        <div class="bg-white overflow-hidden shadow-md rounded-2xl border border-gray-200 hover:shadow-lg transition duration-300">
            <div class="p-6">
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-2xl">⚙️</span>
                    <h4 class="text-lg font-semibold text-gray-800">Administración del Gimnasio</h4>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <a href="{{ route('admin.users.index') }}" class="group block p-4 bg-gradient-to-br from-gray-50 to-blue-50 rounded-xl hover:shadow-md transition-all duration-200 border border-transparent hover:border-blue-300">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">👥</span>
                            <div>
                                <p class="font-medium text-gray-800 group-hover:text-blue-700">Gestionar Miembros</p>
                                <p class="text-sm text-gray-500">Ver, editar o eliminar usuarios</p>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin.plans.index') }}" class="group block p-4 bg-gradient-to-br from-gray-50 to-green-50 rounded-xl hover:shadow-md transition-all duration-200 border border-transparent hover:border-green-300">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">📋</span>
                            <div>
                                <p class="font-medium text-gray-800 group-hover:text-blue-700">Planes de Membresía</p>
                                <p class="text-sm text-gray-500">Crear, editar planes</p>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin.trainers.index') }}" class="group block p-4 bg-gradient-to-br from-gray-50 to-purple-50 rounded-xl hover:shadow-md transition-all duration-200 border border-transparent hover:border-purple-300">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">🏋️</span>
                            <div>
                                <p class="font-medium text-gray-800 group-hover:text-blue-700">Entrenadores</p>
                                <p class="text-sm text-gray-500">Añadir, modificar o eliminar</p>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin.schedules.index') }}" class="group block p-4 bg-gradient-to-br from-gray-50 to-yellow-50 rounded-xl hover:shadow-md transition-all duration-200 border border-transparent hover:border-yellow-300">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">⏰</span>
                            <div>
                                <p class="font-medium text-gray-800 group-hover:text-blue-700">Horarios</p>
                                <p class="text-sm text-gray-500">Configurar horarios del gimnasio</p>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin.gym-config.edit') }}" class="group block p-4 bg-gradient-to-br from-gray-50 to-red-50 rounded-xl hover:shadow-md transition-all duration-200 border border-transparent hover:border-red-300">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">⚙️</span>
                            <div>
                                <p class="font-medium text-gray-800 group-hover:text-blue-700">Dirección y Contacto</p>
                                <p class="text-sm text-gray-500">Actualizar ubicación, teléfono, redes</p>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin.services.index') }}" class="group block p-4 bg-gradient-to-br from-gray-50 to-pink-50 rounded-xl hover:shadow-md transition-all duration-200 border border-transparent hover:border-pink-300">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">📦</span>
                            <div>
                                <p class="font-medium text-gray-800 group-hover:text-blue-700">Servicios</p>
                                <p class="text-sm text-gray-500">Gestionar los servicios del gimnasio</p>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin.slides.index') }}" class="group block p-4 bg-gradient-to-br from-gray-50 to-orange-50 rounded-xl hover:shadow-md transition-all duration-200 border border-transparent hover:border-orange-300">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">🖼️</span>
                            <div>
                                <p class="font-medium text-gray-800 group-hover:text-orange-700">Slides</p>
                                <p class="text-sm text-gray-500">Gestionar el carrusel</p>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin.social-networks.index') }}" class="group block p-4 bg-gradient-to-br from-gray-50 to-cyan-50 rounded-xl hover:shadow-md transition-all duration-200 border border-transparent hover:border-cyan-300">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">🌐</span>
                            <div>
                                <p class="font-medium text-gray-800 group-hover:text-cyan-700">Redes Sociales</p>
                                <p class="text-sm text-gray-500">Gestionar redes sociales</p>
                            </div>
                        </div>
                    </a>
                    <!-- 👇 NUEVO ENLACE: PRECIOS -->
                    <a href="{{ route('admin.prices.index') }}" class="group block p-4 bg-gradient-to-br from-gray-50 to-teal-50 rounded-xl hover:shadow-md transition-all duration-200 border border-transparent hover:border-teal-300">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">💰</span>
                            <div>
                                <p class="font-medium text-gray-800 group-hover:text-teal-700">Precios</p>
                                <p class="text-sm text-gray-500">Gestionar lista de precios</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        @else
        <!-- ========================================== -->
        <!-- PANEL PARA USUARIOS NORMALES               -->
        <!-- ========================================== -->
        <div class="bg-white overflow-hidden shadow-md rounded-2xl border border-gray-200 hover:shadow-lg transition duration-300">
            <div class="p-6">
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-2xl">👤</span>
                    <h4 class="text-lg font-semibold text-gray-800">Mi Área Personal</h4>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('profile.edit') }}" class="group block p-4 bg-gradient-to-br from-gray-50 to-blue-50 rounded-xl hover:shadow-md transition-all duration-200 border border-transparent hover:border-blue-300">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">👤</span>
                            <div>
                                <p class="font-medium text-gray-800 group-hover:text-blue-700">Mi Perfil</p>
                                <p class="text-sm text-gray-500">Actualizar mis datos de acceso</p>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('user-data.index') }}" class="group block p-4 bg-gradient-to-br from-gray-50 to-green-50 rounded-xl hover:shadow-md transition-all duration-200 border border-transparent hover:border-green-300">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">📊</span>
                            <div>
                                <p class="font-medium text-gray-800 group-hover:text-blue-700">Mis Datos</p>
                                <p class="text-sm text-gray-500">Peso, altura, foto y membresía</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- RESUMEN DE MEMBRESÍA (para usuarios normales) -->
        <!-- ========================================== -->
        <div class="bg-white overflow-hidden shadow-md rounded-2xl border border-gray-200 hover:shadow-lg transition duration-300 mt-6">
            <div class="p-6">
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-2xl">💪</span>
                    <h4 class="text-lg font-semibold text-gray-800">Mi Membresía</h4>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-xl">
                        <p class="text-sm text-gray-600">Plan actual</p>
                        <p class="text-lg font-bold text-blue-800">{{ Auth::user()->plan->name ?? 'Sin plan' }}</p>
                    </div>
                    <div class="bg-gradient-to-br from-green-50 to-green-100 p-4 rounded-xl">
                        <p class="text-sm text-gray-600">Válida hasta</p>
                        <p class="text-lg font-bold text-green-800">
                            {{ Auth::user()->membership_expires_at ? \Carbon\Carbon::parse(Auth::user()->membership_expires_at)->format('d/m/Y') : 'No definida' }}
                        </p>
                    </div>
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-4 rounded-xl">
                        <p class="text-sm text-gray-600">Peso</p>
                        <p class="text-lg font-bold text-purple-800">{{ Auth::user()->weight ? Auth::user()->weight . ' kg' : '—' }}</p>
                    </div>
                    <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-4 rounded-xl">
                        <p class="text-sm text-gray-600">Altura</p>
                        <p class="text-lg font-bold text-yellow-800">{{ Auth::user()->height ? Auth::user()->height . ' cm' : '—' }}</p>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    @php $status = Auth::user()->membership_status; @endphp
                    <span style="display: inline-block; padding: 8px 24px; border-radius: 50px; color: white; font-weight: 600; background-color: 
                        @if($status['color'] == 'success') #28a745
                        @elseif($status['color'] == 'warning') #ffc107
                        @elseif($status['color'] == 'danger') #dc3545
                        @else #6c757d @endif;">
                        <i class="bi {{ $status['icon'] }} me-1"></i> {{ $status['text'] }}
                    </span>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection