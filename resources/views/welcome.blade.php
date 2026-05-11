<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Generador de Tesones — ISSSTE</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gradient-to-br from-slate-900 via-blue-900 to-blue-800">
    <div class="flex min-h-screen items-center justify-center px-4">
        <div class="text-center">
            <div class="bg-white/10 backdrop-blur-md rounded-3xl shadow-2xl p-12 max-w-lg">
                <img src="{{ asset('fotos/60issste.png') }}" alt="ISSSTE"
                     class="mx-auto h-16 mb-8">
                <h1 class="text-4xl font-bold text-white mb-3 tracking-tight">
                    Generador de Tesones
                </h1>
                <p class="text-blue-200 text-lg mb-10">
                    ISSSTE — Delegación Estatal B.C.
                </p>
                <div class="space-y-3">
                    <a href="{{ route('login') }}"
                       class="flex items-center justify-center gap-3 w-full px-6 py-3.5 bg-white text-blue-900 font-semibold rounded-xl hover:bg-blue-50 transition-all shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                        Iniciar Sesión
                    </a>
                    <a href="{{ route('register') }}"
                       class="flex items-center justify-center gap-3 w-full px-6 py-3.5 border-2 border-white/30 text-white font-semibold rounded-xl hover:bg-white/10 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                        Registrarse
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
