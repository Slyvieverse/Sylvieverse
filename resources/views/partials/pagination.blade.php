@if ($paginator->hasPages())
    <nav class="flex justify-center items-center space-x-2 mt-6">
        <!-- Previous Page Link -->
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 text-sm font-medium text-secondary-200 bg-secondary-800/50 border border-secondary-700/40 rounded-full backdrop-blur-md cursor-not-allowed">
                &laquo; Prev
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
               class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-primary-500 border border-primary-700 rounded-full shadow-sm hover:shadow-lg hover:from-primary-500 hover:to-accent-500 transition-all duration-200">
                &laquo; Prev
            </a>
        @endif

        <!-- Page Number Links -->
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-4 py-2 text-sm text-secondary-300 bg-secondary-800/50 border border-secondary-700/40 rounded-full backdrop-blur-md">
                    {{ $element }}
                </span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-4 py-2 text-sm font-bold text-white bg-gradient-to-r from-accent-600 to-primary-600 border border-primary-700 rounded-full shadow-md">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                           class="px-4 py-2 text-sm text-white bg-secondary-800/60 border border-secondary-700/40 rounded-full backdrop-blur-md hover:bg-gradient-to-r hover:from-primary-600 hover:to-accent-500 hover:shadow-lg transition-all duration-200">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        <!-- Next Page Link -->
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
               class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-primary-500 border border-primary-700 rounded-full shadow-sm hover:shadow-lg hover:from-primary-500 hover:to-accent-500 transition-all duration-200">
                Next &raquo;
            </a>
        @else
            <span class="px-4 py-2 text-sm font-medium text-secondary-200 bg-secondary-800/50 border border-secondary-700/40 rounded-full backdrop-blur-md cursor-not-allowed">
                Next &raquo;
            </span>
        @endif
    </nav>
@endif
