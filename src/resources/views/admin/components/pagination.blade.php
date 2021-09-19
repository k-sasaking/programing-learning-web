@if ($paginator->hasPages())
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item @if ($paginator->onFirstPage()) disabled @endif"><a class="page-link" href="{{ $paginator->url(1) }}">&lt;&lt; 最初</a></li>
        <li class="page-item @if ($paginator->onFirstPage()) disabled @endif"><a class="page-link" href="{{ $paginator->previousPageUrl() }}">&lt;</a></li>
    @foreach ($elements as $element)
        @if (is_string($element))
            <p class="page-skip disabled"><span class="skip">...</span></p>
        @endif      
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <li class="page-item @if ($page == $paginator->currentPage()) disabled @endif"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endforeach
            @endif
    @endforeach
        <li class="page-item @if (!$paginator->hasMorePages()) disabled @endif"><a class="page-link" href="{{ $paginator->nextPageUrl() }}">&gt;</a></li>
        <li class="page-item @if ($paginator->currentPage() == $paginator->lastPage()) disabled @endif"><a class="page-link" href="{{ $paginator->url($paginator->lastPage())}}">最後&gt;&gt;</a></li>
    </ul>
</nav>
@endif
