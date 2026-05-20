@if ($paginator->hasPages())
<nav class="pagination" role="navigation" aria-label="Paginação">
    {{-- Previous --}}
    @if ($paginator->onFirstPage())
        <span aria-disabled="true">‹ Anterior</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev">‹ Anterior</a>
    @endif

    {{-- Pages --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <span>{{ $element }}</span>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="active" aria-current="page"><span>{{ $page }}</span></span>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" rel="next">Próximo ›</a>
    @else
        <span aria-disabled="true">Próximo ›</span>
    @endif
</nav>
@endif
