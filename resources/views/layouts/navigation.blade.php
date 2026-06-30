<nav x-data="{ open: false, adminOpen: false }" class="bg-gray-900 border-b border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14 items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="flex items-center">
                    @php $config = App\Models\GymConfig::first(); @endphp
                    @if($config && $config->logo)
                        <img src="{{ asset('storage/' . $config->logo) }}" alt="Logo" class="h-8 w-auto">
                    @else
                        <span class="text-lg font-semibold text-white">SiteFit</span>
                    @endif
                </a>
            </div>

            <!-- Enlaces principales (escritorio) -->
            <div class="hidden sm:flex sm:items-center sm:space-x-6">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-sm font-medium text-gray-300 hover:text-white">
                    {{ __('Panel') }}
                </x-nav-link>

                @auth
                    @if(Auth::user()->is_admin)
                        <!-- Dropdown Admin minimalista oscuro -->
                        <div class="relative" x-data="{ adminOpen: false }">
                            <button @click="adminOpen = !adminOpen" class="text-sm font-medium text-gray-300 hover:text-white focus:outline-none">
                                Admin
                                <svg class="inline-block w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div x-show="adminOpen" @click.away="adminOpen = false" class="absolute right-0 mt-2 w-48 bg-gray-800 rounded-md shadow-lg py-1 z-50">
                                <a href="{{ route('admin.slides.index') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Carrusel</a>
                                <a href="{{ route('admin.gym-config.edit') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Configuración</a>
                                <a href="{{ route('admin.trainers.index') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Entrenadores</a>
                                <a href="{{ route('admin.schedules.index') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Horarios</a>
                                <a href="{{ route('admin.plans.index') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Planes</a>
                                <a href="{{ route('admin.prices.index') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Precios</a>
                                <a href="{{ route('admin.faqs.index') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Preguntas Frecuentes</a>
                                <a href="{{ route('admin.social-networks.index') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Redes Sociales</a>
                                <a href="{{ route('admin.services.index') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Servicios</a>
                                <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Usuarios</a>
                            </div>
                        </div>
                    @endif
                @endauth
            </div>

            <!-- Menú de usuario (escritorio) -->
            <div class="hidden sm:flex sm:items-center sm:space-x-4">
                @auth
                    <div class="relative" x-data="{ userOpen: false }">
                        <button @click="userOpen = !userOpen" class="flex items-center text-sm text-gray-300 hover:text-white focus:outline-none">
                            @if(Auth::user()->profile_photo)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Avatar" class="w-8 h-8 rounded-full object-cover">
                            @else
                                <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-semibold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <svg class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="userOpen" @click.away="userOpen = false" class="absolute right-0 mt-2 w-48 bg-gray-800 rounded-md shadow-lg py-1 z-50">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Perfil</a>
                            <a href="{{ route('user-data.index') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Mis Datos</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Cerrar sesión</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-300 hover:text-white">Iniciar sesión</a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="flex items-center sm:hidden">
                <button @click="open = !open" class="text-gray-400 hover:text-white focus:outline-none">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (móvil) -->
    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="sm:hidden bg-gray-900 border-t border-gray-800">
        <div class="px-4 pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-800 hover:text-white rounded-md">Panel</a>

            @auth
                @if(Auth::user()->is_admin)
                    <div x-data="{ mobileAdminOpen: false }">
                        <button @click="mobileAdminOpen = !mobileAdminOpen" class="flex justify-between w-full px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-800 hover:text-white rounded-md">
                            <span>Admin</span>
                            <svg class="w-5 h-5 transition-transform" :class="{'rotate-180': mobileAdminOpen}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="mobileAdminOpen" class="pl-4 space-y-1">
                            <a href="{{ route('admin.slides.index') }}" class="block px-3 py-2 text-sm text-gray-400 hover:bg-gray-800 hover:text-white rounded-md">Carrusel</a>
                            <a href="{{ route('admin.gym-config.edit') }}" class="block px-3 py-2 text-sm text-gray-400 hover:bg-gray-800 hover:text-white rounded-md">Configuración</a>
                            <a href="{{ route('admin.trainers.index') }}" class="block px-3 py-2 text-sm text-gray-400 hover:bg-gray-800 hover:text-white rounded-md">Entrenadores</a>
                            <a href="{{ route('admin.schedules.index') }}" class="block px-3 py-2 text-sm text-gray-400 hover:bg-gray-800 hover:text-white rounded-md">Horarios</a>
                            <a href="{{ route('admin.plans.index') }}" class="block px-3 py-2 text-sm text-gray-400 hover:bg-gray-800 hover:text-white rounded-md">Planes</a>
                            <a href="{{ route('admin.prices.index') }}" class="block px-3 py-2 text-sm text-gray-400 hover:bg-gray-800 hover:text-white rounded-md">Precios</a>
                            <a href="{{ route('admin.faqs.index') }}" class="block px-3 py-2 text-sm text-gray-400 hover:bg-gray-800 hover:text-white rounded-md">Preguntas Frecuentes</a>
                            <a href="{{ route('admin.social-networks.index') }}" class="block px-3 py-2 text-sm text-gray-400 hover:bg-gray-800 hover:text-white rounded-md">Redes Sociales</a>
                            <a href="{{ route('admin.services.index') }}" class="block px-3 py-2 text-sm text-gray-400 hover:bg-gray-800 hover:text-white rounded-md">Servicios</a>
                            <a href="{{ route('admin.users.index') }}" class="block px-3 py-2 text-sm text-gray-400 hover:bg-gray-800 hover:text-white rounded-md">Usuarios</a>
                        </div>
                    </div>
                @endif

                <!-- ===== SEPARADOR VISUAL ===== -->
                <div class="border-t-2 border-gray-700 my-2"></div>

                <!-- ===== PERFIL EN MÓVIL (CON FOTO) ===== -->
                <div class="text-xs font-semibold text-gray-300 uppercase tracking-wider px-3 py-1">Cuenta</div>
            
                <!-- Avatar + Nombre + Email -->
                <div class="flex items-center gap-3 px-3 py-2">
                    @if(Auth::user()->profile_photo)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Foto" class="w-10 h-10 rounded-full object-cover border border-gray-600">
                    @else
                        <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center text-sm font-semibold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                    <div>
                        <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <!-- Enlaces de perfil -->
                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-800 hover:text-white rounded-md">Perfil</a>
                <a href="{{ route('user-data.index') }}" class="block px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-800 hover:text-white rounded-md">Mis Datos</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-800 hover:text-white rounded-md">Cerrar sesión</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-800 hover:text-white rounded-md">Iniciar sesión</a>
            @endauth
        </div>
    </div>
</nav>