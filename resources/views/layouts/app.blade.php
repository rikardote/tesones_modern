<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Pragma" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'ISSSTE') | Generador de Tesones</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('css')
</head>
<body class="h-full bg-gray-50 text-gray-800 antialiased">

    @include('partials.nav')

    <main class="pt-20 pb-12">
        <div class="mx-auto px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-24">
            {{-- Flash alerts --}}
            @if (session('flash_message'))
                <div x-data="{ show: true }"
                     x-show="show"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     x-init="setTimeout(() => show = false, 6000)"
                     class="mb-6">
                    <div class="alert alert-{{ session('flash_level', 'info') }}">
                        <div class="flex-1">{{ session('flash_message') }}</div>
                        <button @click="show = false" class="alert-close">&times;</button>
                    </div>
                </div>
            @endif

            {{-- Validation errors --}}
            @if ($errors->any())
                <div x-data="{ show: true }"
                     x-show="show"
                     x-init="setTimeout(() => show = false, 8000)"
                     class="alert alert-danger mb-6">
                    <div class="flex-1">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button @click="show = false" class="alert-close">&times;</button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    @yield('js')
</body>
</html>
