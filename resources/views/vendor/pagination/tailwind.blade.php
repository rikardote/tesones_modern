@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Paginación" class="flex flex-col sm:flex-row items-center justify-between gap-4">
        {{-- Info text --}}
        <div class="text-sm text-gray-500">
            @if ($paginator->total() > 0)
                Mostrando <span class="font-semibold text-gray-700">{{ $paginator->firstItem() }}</span>
                – <span class="font-semibold text-gray-700">{{ $paginator->lastItem() }}</span>
                de <span class="font-semibold text-gray-700">{{ number_format($paginator->total()) }}</span> registros
                (pág. {{ $paginator->currentPage() }} de {{ $paginator->lastPage() }})
            @endif
        </div>

        {{-- Page buttons --}}
        <div class="flex items-center gap-1 flex-wrap justify-center">
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span class="flex items-center justify-center w-9 h-9 rounded-lg text-sm text-gray-300 cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="flex items-center justify-center w-9 h-9 rounded-lg text-sm text-gray-600 hover:bg-gray-100 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
            @endif

            {{-- Page numbers --}}
            @foreach ($elements as $element)
                {{-- Separador "..." --}}
                @if (is_string($element))
                    <span class="flex items-center justify-center w-9 h-9 rounded-lg text-sm text-gray-400 font-medium">{{ $element }}</span>
                @endif

                {{-- Links de páginas --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page" class="flex items-center justify-center min-w-[2.25rem] h-9 rounded-lg text-sm font-bold bg-blue-600 text-white shadow-sm">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="flex items-center justify-center min-w-[2.25rem] h-9 rounded-lg text-sm text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition-colors font-medium" aria-label="Ir a página {{ $page }}">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="flex items-center justify-center w-9 h-9 rounded-lg text-sm text-gray-600 hover:bg-gray-100 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            @else
                <span class="flex items-center justify-center w-9 h-9 rounded-lg text-sm text-gray-300 cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </span>
            @endif
        </div>
    </nav>
@endif
