<nav x-data="{ open: false }"
     class="fixed inset-x-0 top-0 z-50 bg-gradient-to-r from-blue-700 to-blue-900 shadow-lg">
    <div class="mx-auto px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-24">
        <div class="flex h-16 items-center justify-between">
            {{-- Logo --}}
            <a href="{{ url('/') }}" class="flex items-center gap-2 text-white font-bold text-lg tracking-tight hover:text-blue-200 transition-colors">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                TESONES
            </a>

            {{-- Desktop nav --}}
            <div class="hidden md:flex md:items-center md:gap-1">
                @auth
                    <a href="{{ url('/tesones/create') }}" class="flex items-center gap-1.5 px-3 py-2 text-sm font-medium text-white/90 hover:text-white hover:bg-white/10 rounded-lg transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        CREAR TESÓN
                    </a>
                @endauth

                <div class="mx-2 h-5 w-px bg-white/20"></div>

                @guest
                    <a href="{{ url('/login') }}" class="flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-white/10 hover:bg-white/20 rounded-lg transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                        Login
                    </a>
                @else
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                                class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-white/90 hover:text-white hover:bg-white/10 rounded-lg transition-all">
                            <span class="flex items-center justify-center w-7 h-7 bg-white/20 rounded-full text-xs font-semibold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </span>
                            {{ Auth::user()->name }}
                            <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open"
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-200 py-1 z-50">
                            <a href="{{ url('/usuarios') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Actualizar Información
                            </a>
                            @if(Auth::user()->isAdmin())
                                <div class="border-t border-gray-100 my-1"></div>
                                <div class="px-4 py-1.5">
                                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Admin</span>
                                </div>
                                <a href="{{ url('/users_all') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                    Modificar Usuarios
                                </a>
                                <a href="{{ url('/info_nominas') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/></svg>
                                    Agregar Nóminas
                                </a>
                                <a href="{{ url('/todas') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                    Todos los Tesones
                                </a>
                            @endif
                            <div class="border-t border-gray-100 my-1"></div>
                            <a href="{{ url('/logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               class="flex items-center gap-2 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                Cerrar Sesión
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest
            </div>

            {{-- Mobile menu button --}}
            <button @click="open = !open" class="md:hidden p-2 text-white/90 hover:text-white rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Mobile menu --}}
        <div x-show="open"
             x-transition
             class="md:hidden pb-4 space-y-1">
            @auth
                <a href="{{ url('/tesones/create') }}" class="block px-3 py-2 text-sm font-medium text-white/90 hover:text-white hover:bg-white/10 rounded-lg">
                    + Crear Tesón
                </a>
            @endauth
            @guest
                <a href="{{ url('/login') }}" class="block px-3 py-2 text-sm font-medium text-white/90 hover:text-white hover:bg-white/10 rounded-lg">
                    Login
                </a>
            @else
                <div class="border-t border-white/20 pt-2 mt-2">
                    <p class="px-3 py-1 text-xs text-white/60">{{ Auth::user()->name }}</p>
                    <a href="{{ url('/usuarios') }}" class="block px-3 py-2 text-sm text-white/80 hover:text-white hover:bg-white/10 rounded-lg">Actualizar Info</a>
                    @if(Auth::user()->isAdmin())
                        <a href="{{ url('/users_all') }}" class="block px-3 py-2 text-sm text-white/80 hover:text-white hover:bg-white/10 rounded-lg">Modificar Usuarios</a>
                        <a href="{{ url('/info_nominas') }}" class="block px-3 py-2 text-sm text-white/80 hover:text-white hover:bg-white/10 rounded-lg">Nóminas</a>
                        <a href="{{ url('/todas') }}" class="block px-3 py-2 text-sm text-white/80 hover:text-white hover:bg-white/10 rounded-lg">Todos los Tesones</a>
                    @endif
                    <a href="{{ url('/logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="block px-3 py-2 text-sm text-red-300 hover:text-red-200 hover:bg-white/10 rounded-lg">
                        Cerrar Sesión
                    </a>
                </div>
            @endguest
        </div>
    </div>
</nav>
