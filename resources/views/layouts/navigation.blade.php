<nav class="bg-white border-b border-gray-200 shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="flex items-center space-x-2">
                    <span class="text-lg font-bold text-gray-800">Gestión de Residuos</span>
                </a>
            </div>

            <!-- Links desktop -->
            <div class="hidden sm:flex sm:space-x-6 sm:items-center">
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-green-600 font-medium">Inicio</a>
                <a href="{{ url('/vehiculos/mapa') }}" class="text-gray-700 hover:text-green-600 font-medium">Mapa de Vehículos</a>

                @auth
                    {{-- 🔹 Enlaces para ADMINISTRADOR --}}
                    @if(Auth::user()->role === 'administrador')
                        <a href="{{ url('/admin/roles') }}" class="text-gray-700 hover:text-green-600 font-medium">Roles</a>
                        <a href="{{ url('/zonas') }}" class="text-gray-700 hover:text-green-600 font-medium">Zonas</a>
                        <a href="{{ url('/mantenimientos') }}" class="text-gray-700 hover:text-green-600 font-medium">Mantenimientos</a>
                        <a href="{{ url('/planificaciones') }}" class="text-gray-700 hover:text-green-600 font-medium">Planificaciones</a>
                        <a href="{{ url('/reportes') }}" class="text-gray-700 hover:text-green-600 font-medium">Reportes</a> {{-- ✅ agregado --}}
                    @endif

                    {{-- 🔹 Enlaces para CIUDADANO --}}
                    @if(Auth::user()->role === 'ciudadano')
                        <a href="{{ url('/reportes') }}" class="text-gray-700 hover:text-green-600 font-medium">Mis Reportes</a>
                    @endif

                    {{-- 🔹 Enlaces para CONDUCTOR --}}
                    @if(Auth::user()->role === 'conductor')
                        <a href="{{ url('/mantenimientos') }}" class="text-gray-700 hover:text-green-600 font-medium">Mantenimientos</a>
                        <a href="{{ url('/planificaciones') }}" class="text-gray-700 hover:text-green-600 font-medium">Rutas Asignadas</a>
                    @endif
                @endauth
            </div>

            <!-- Usuario -->
            <div class="hidden sm:flex sm:items-center space-x-4">
                @auth
                    <span class="text-gray-600">{{ Auth::user()->nombres ?? Auth::user()->email }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium">
                            Cerrar sesión
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-green-600">Iniciar sesión</a>
                    <a href="{{ route('register') }}" class="text-sm text-gray-600 hover:text-green-600">Registrarse</a>
                @endauth
            </div>

            <!-- Botón móvil -->
            <div class="flex items-center sm:hidden">
                <button id="menu-toggle" class="text-gray-600 hover:text-gray-800 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menú móvil -->
    <div id="mobile-menu" class="hidden sm:hidden px-4 pb-4 space-y-2">
        <a href="{{ url('/') }}" class="block text-gray-700 hover:text-green-600">Inicio</a>
        <a href="{{ url('/vehiculos/mapa') }}" class="block text-gray-700 hover:text-green-600">Mapa de Vehículos</a>

        @auth
            {{-- 🔹 Enlaces para ADMINISTRADOR --}}
            @if(Auth::user()->role === 'administrador')
                <a href="{{ url('/admin/roles') }}" class="block text-gray-700 hover:text-green-600">Roles</a>
                <a href="{{ url('/zonas') }}" class="block text-gray-700 hover:text-green-600">Zonas</a>
                <a href="{{ url('/mantenimientos') }}" class="block text-gray-700 hover:text-green-600">Mantenimientos</a>
                <a href="{{ url('/planificaciones') }}" class="block text-gray-700 hover:text-green-600">Planificaciones</a>
                <a href="{{ url('/reportes') }}" class="block text-gray-700 hover:text-green-600">Reportes</a> {{-- ✅ agregado --}}
            @endif

            {{-- 🔹 Enlaces para CIUDADANO --}}
            @if(Auth::user()->role === 'ciudadano')
                <a href="{{ url('/reportes') }}" class="block text-gray-700 hover:text-green-600">Mis Reportes</a>
            @endif

            {{-- 🔹 Enlaces para CONDUCTOR --}}
            @if(Auth::user()->role === 'conductor')
                <a href="{{ url('/mantenimientos') }}" class="block text-gray-700 hover:text-green-600">Mantenimientos</a>
                <a href="{{ url('/planificaciones') }}" class="block text-gray-700 hover:text-green-600">Rutas Asignadas</a>
            @endif

            <span class="block text-gray-600">{{ Auth::user()->nombres ?? Auth::user()->email }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left text-red-600 hover:text-red-800">
                    Cerrar sesión
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="block text-gray-600 hover:text-green-600">Iniciar sesión</a>
            <a href="{{ route('register') }}" class="block text-gray-600 hover:text-green-600">Registrarse</a>
        @endauth
    </div>
</nav>

<script>
    // Script simple para abrir/cerrar el menú móvil
    document.getElementById('menu-toggle').addEventListener('click', function () {
        let menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>
