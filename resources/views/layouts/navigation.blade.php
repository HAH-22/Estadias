<nav x-data="{ open: false, adminOpen: false }" class="bg-gray-900">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}">
                        @php $config = App\Models\GymConfig::first(); @endphp
                        @if($config && $config->logo)
                            <img src="{{ asset('storage/' . $config->logo) }}" alt="Logo" class="block h-9 w-auto">
                        @else
                            <x-application-logo class="block h-9 w-auto fill-current text-white" />
                        @endif
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex sm:items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Inicio') }}
                    </x-nav-link>

                    @auth

                        @if(Auth::user()->is_admin)
                            <div class="relative" x-data="{ adminOpen: false }">
                                <button @click="adminOpen = !adminOpen" 
                                        class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-white hover:bg-[#1a3a6b] focus:outline-none transition duration-150 ease-in-out">
                                    <span>Admin</span>
                                    <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div x-show="adminOpen" 
                                     @click.away="adminOpen = false"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="opacity-100 scale-100"
                                     x-transition:leave-end="opacity-0 scale-95"
                                     class="absolute z-50 mt-2 w-48 rounded-md shadow-lg bg-gray-800 ring-1 ring-gray-700"
                                     style="display: none;"
                                     x-bind:style="adminOpen ? 'display: block;' : 'display: none;'">
                                    <div class="py-1">
                                        <x-dropdown-link :href="route('admin.plans.index')">
                                            {{ __('Planes') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('admin.prices.index')">
                                            {{ __('Precios') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('admin.users.index')">
                                            {{ __('Usuarios') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('admin.trainers.index')">
                                            {{ __('Entrenadores') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('admin.services.index')">
                                            {{ __('Servicios') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('admin.schedules.index')">
                                            {{ __('Horarios') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('admin.social-networks.index')">
                                            {{ __('Redes Sociales') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('admin.gym-config.edit')">
                                            {{ __('Configuración') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('admin.slides.index')">
                                            {{ __('Carrusel') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('admin.faqs.index')">
                                            {{ __('Preguntas Frecuentes') }}
                                        </x-dropdown-link>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>

            @auth
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48" class="dropdown-usuario">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-gray-800 hover:bg-[#1a3a6b] focus:outline-none transition duration-150 ease-in-out">
                                @if(Auth::user()->profile_photo)
                                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Foto" class="w-8 h-8 rounded-full object-cover mr-2">
                                @else
                                    <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white text-sm font-bold mr-2">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Perfil') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('user-data.index')">
                                {{ __('Mis Datos') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Cerrar sesión') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @else
                <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                    <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-white underline">Iniciar sesión</a>
                </div>
            @endauth

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-gray-300 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (móvil) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Inicio') }}
            </x-responsive-nav-link>

            @auth

                @if(Auth::user()->is_admin)
                    <div x-data="{ mobileAdminOpen: false }">
                        <button @click="mobileAdminOpen = !mobileAdminOpen" class="w-full text-left px-4 py-2 text-sm font-medium text-white hover:bg-[#1a3a6b] transition">
                            <span>Admin</span>
                            <svg class="inline-block ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="mobileAdminOpen" class="pl-4 space-y-1">
                            <x-responsive-nav-link :href="route('admin.plans.index')">
                                {{ __('Planes') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('admin.prices.index')">
                                {{ __('Precios') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('admin.users.index')">
                                {{ __('Usuarios') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('admin.trainers.index')">
                                {{ __('Entrenadores') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('admin.services.index')">
                                {{ __('Servicios') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('admin.schedules.index')">
                                {{ __('Horarios') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('admin.social-networks.index')">
                                {{ __('Redes Sociales') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('admin.gym-config.edit')">
                                {{ __('Configuración') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('admin.slides.index')">
                                {{ __('Carrusel') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('admin.faqs.index')">
                                {{ __('Preguntas Frecuentes') }}
                            </x-responsive-nav-link>
                        </div>
                    </div>
                @endif
            @endauth
        </div>

        @auth
            <div class="pt-4 pb-1 border-t border-gray-700">
                <div class="px-4">
                    <div class="flex items-center gap-3">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Foto" class="w-10 h-10 rounded-full object-cover">
                        @else
                            <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white text-lg font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Perfil') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('user-data.index')">
                        {{ __('Mis Datos') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Cerrar sesión') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-1 border-t border-gray-700">
                <div class="px-4 space-y-2">
                    <a href="{{ route('login') }}" class="block text-sm text-gray-300 hover:text-white">Iniciar sesión</a>
                </div>
            </div>
        @endauth
    </div>
</nav>