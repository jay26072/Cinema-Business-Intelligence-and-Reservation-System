@if ($paginator->hasPages())
<div class="pagination-area text-center">

    {{-- Prev --}}
    @if ($paginator->onFirstPage())
        <a href="javascript:void(0)" class="disabled">
            <i class="fas fa-angle-double-left"></i><span>Prev</span>
        </a>
    @else
        <a href="{{ $paginator->previousPageUrl() }}">
            <i class="fas fa-angle-double-left"></i><span>Prev</span>
        </a>
    @endif

    {{-- Page Numbers --}}
    @foreach ($elements as $element)

        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <a href="javascript:void(0)">...</a>
        @endif

        {{-- Page Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <a href="javascript:void(0)" class="active">{{ $page }}</a>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
        @endif

    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}">
            <span>Next</span><i class="fas fa-angle-double-right"></i>
        </a>
    @else
        <a href="javascript:void(0)" class="disabled">
            <span>Next</span><i class="fas fa-angle-double-right"></i>
        </a>
    @endif

</div>
@endif