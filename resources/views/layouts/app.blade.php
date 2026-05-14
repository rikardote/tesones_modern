<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Pragma" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'ISSSTE') | Generador de Tesones</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @yield('css')
</head>
<body class="h-full bg-slate-50 antialiased font-['Inter',sans-serif] selection:bg-blue-100 selection:text-blue-900" x-data="{ sidebarOpen: false }">

    {{-- Mobile topbar --}}
    <header class="mobile-topbar md:hidden backdrop-blur-md bg-slate-900/90 border-b border-white/5">
        <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-xl text-white/80 hover:text-white hover:bg-white/10 mr-3 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
        <a href="{{ url('/') }}" class="text-white font-black text-sm tracking-[0.2em] uppercase">Tesones</a>
    </header>

    {{-- Sidebar overlay (mobile) --}}
    <div x-show="sidebarOpen"
         x-cloak
         @click="sidebarOpen = false"
         class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-30 md:hidden"
         x-transition:enter="transition duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
    </div>

    {{-- Sidebar --}}
    <aside class="sidebar border-r border-white/5 shadow-2xl" :class="sidebarOpen ? 'open' : ''" x-cloak>
        {{-- Logo --}}
        <div class="px-6 py-8">
            <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                <div class="p-2 bg-blue-600 rounded-xl shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <span class="text-white font-black text-lg tracking-tighter uppercase group-hover:text-blue-400 transition-colors">Tesones<span class="text-blue-500 font-normal">.</span></span>
            </a>
        </div>

        {{-- Nav links --}}
        <nav class="flex-1 px-3 space-y-1 overflow-y-auto custom-scrollbar">
            @auth
                <div class="px-3 pb-2 mt-4">
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">Principal</p>
                </div>

                <a href="{{ url('/') }}"
                   class="sidebar-link group {{ request()->is('/') ? 'active' : '' }}">
                    <svg class="w-4 h-4 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7v10c0 .55.45 1 1 1h5v-5h4v5h5a1 1 0 001-1V7l-8-5-8 5z"/>
                    </svg>
                    <span>Inicio</span>
                </a>

                <a href="{{ url('/tesones/create') }}"
                   class="sidebar-link group {{ request()->is('tesones/create') ? 'active' : '' }}">
                    <svg class="w-4 h-4 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Nuevo Tesón</span>
                </a>

                @if(Auth::user()->isAdmin())
                    <div class="px-3 pb-2 mt-8">
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">Administración</p>
                    </div>

                    <a href="{{ url('/todas') }}"
                       class="sidebar-link group {{ request()->is('todas') ? 'active' : '' }}">
                        <svg class="w-4 h-4 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <span>Todos los Tesones</span>
                    </a>

                    <a href="{{ url('/info_nominas') }}"
                       class="sidebar-link group {{ request()->is('info_nominas') ? 'active' : '' }}">
                        <svg class="w-4 h-4 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>
                        </svg>
                        <span>Catálogo de Nóminas</span>
                    </a>

                    <a href="{{ url('/users_all') }}"
                       class="sidebar-link group {{ request()->is('users_all') ? 'active' : '' }}">
                        <svg class="w-4 h-4 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span>Gestionar Usuarios</span>
                    </a>
                @endif

                <div class="px-3 pb-2 mt-auto pt-8">
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">Ajustes</p>
                </div>

                <a href="{{ url('/usuarios') }}"
                   class="sidebar-link group {{ request()->is('usuarios') ? 'active' : '' }}">
                    <svg class="w-4 h-4 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span>Configurar Perfil</span>
                </a>
            @endauth
        </nav>

        {{-- Sidebar footer --}}
        @auth
        <div class="mt-auto p-4 bg-white/5 backdrop-blur-md m-3 rounded-2xl border border-white/5">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center text-xs font-black shadow-lg shadow-blue-500/20 uppercase">
                    {{ substr(Auth::user()->name, 0, 1) }}{{ substr(strrchr(Auth::user()->name, ' '), 1, 1) ?: '' }}
                </div>
                <div class="overflow-hidden">
                    <p class="text-white text-xs font-black truncate tracking-tight uppercase">{{ Auth::user()->name }}</p>
                    <p class="text-slate-400 text-[9px] font-bold truncate uppercase tracking-widest">{{ Auth::user()->adscripcion ?? 'Personal' }}</p>
                </div>
            </div>
            <form action="{{ url('/logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="flex items-center justify-center gap-2 w-full px-4 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest text-red-400 hover:text-white hover:bg-red-500 transition-all duration-300">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Cerrar Sesión
                </button>
            </form>
        </div>
        @else
        <div class="mt-auto p-4">
            <a href="{{ url('/login') }}" class="sidebar-link bg-blue-600 text-white hover:bg-blue-700 active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                <span>Acceder al Sistema</span>
            </a>
        </div>
        @endguest
    </aside>

    {{-- Page wrapper --}}
    <div class="page-wrapper min-h-screen">
        <main class="content-area py-10">
            @yield('content')
        </main>
        
        <footer class="mt-auto py-6 px-8 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">&copy; {{ date('Y') }} ISSSTE - Representación Estatal Baja California</p>
            <div class="flex items-center gap-6">
                <span class="text-[10px] font-bold text-slate-300 uppercase tracking-widest flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    Sistema Operativo
                </span>
            </div>
        </footer>
    </div>

    {{-- Toaster Component --}}
    <div x-data="{ 
            toasts: [],
            add(toast) {
                const id = Date.now();
                this.toasts.push({ id, ...toast });
                setTimeout(() => this.remove(id), toast.duration || 5000);
            },
            remove(id) {
                this.toasts = this.toasts.filter(t => t.id !== id);
            }
         }"
         @toast.window="add($event.detail)"
         x-init="
            @if(session('flash_message'))
                setTimeout(() => add({ 
                    message: '{{ session('flash_message') }}', 
                    type: '{{ session('flash_level', 'info') }}' 
                }), 500);
            @endif
         "
         class="fixed top-6 right-6 z-[9999] flex flex-col gap-3 w-full max-w-sm pointer-events-none">
        
        <template x-for="toast in toasts" :key="toast.id">
            <div x-show="true"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-x-12"
                 x-transition:enter-end="opacity-100 translate-x-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-x-0"
                 x-transition:leave-end="opacity-0 translate-x-8"
                 class="pointer-events-auto bg-white rounded-2xl shadow-2xl ring-1 ring-slate-200 p-4 flex items-center gap-4 border-l-4 overflow-hidden"
                 :class="{
                    'border-emerald-500': toast.type === 'success' || toast.type === 'success',
                    'border-blue-500': toast.type === 'info',
                    'border-amber-500': toast.type === 'warning',
                    'border-red-500': toast.type === 'danger' || toast.type === 'error'
                 }">
                
                <div class="w-8 h-8 rounded-xl flex items-center justify-center shrink-0 shadow-sm"
                     :class="{
                        'bg-emerald-100 text-emerald-600': toast.type === 'success',
                        'bg-blue-100 text-blue-600': toast.type === 'info',
                        'bg-amber-100 text-amber-600': toast.type === 'warning',
                        'bg-red-100 text-red-600': toast.type === 'danger' || toast.type === 'error'
                     }">
                    <svg x-show="toast.type === 'success'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    <svg x-show="toast.type === 'info'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <svg x-show="toast.type === 'warning'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <svg x-show="toast.type === 'danger' || toast.type === 'error'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>

                <div class="flex-1 min-w-0">
                    <p class="text-slate-900 text-xs font-black uppercase tracking-tight truncate" x-text="toast.message"></p>
                </div>

                <button @click="remove(toast.id)" class="p-1.5 hover:bg-slate-50 rounded-lg text-slate-400 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l18 18"/></svg>
                </button>
            </div>
        </template>
    </div>

    @stack('js')
    @yield('js')
    @livewireScripts
</body>
</html>
