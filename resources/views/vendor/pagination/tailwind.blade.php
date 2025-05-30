@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center space-x-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-2 text-gray-400 bg-gray-100 border rounded cursor-not-allowed">
                <i class="fas fa-angle-left"></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
               class="px-3 py-2 text-blue-600 bg-white border border-gray-300 rounded hover:bg-blue-50">
                <i class="fas fa-angle-left"></i>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="px-3 py-2 text-gray-500 bg-white border border-gray-300 rounded">{{ $element }}</span>
            @endif

            {{-- Array of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page"
                              class="px-3 py-2 text-white bg-blue-600 border border-blue-600 rounded">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}"
                           class="px-3 py-2 text-blue-600 bg-white border border-gray-300 rounded hover:bg-blue-50">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
               class="px-3 py-2 text-blue-600 bg-white border border-gray-300 rounded hover:bg-blue-50">
                <i class="fas fa-angle-right"></i>
            </a>
        @else
            <span class="px-3 py-2 text-gray-400 bg-gray-100 border rounded cursor-not-allowed">
                <i class="fas fa-angle-right"></i>
            </span>
        @endif
    </nav>
@endif
