@if ($paginator->hasPages())
<style>
    .custom-pagination-container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        margin: 2rem 0;
    }
    .custom-pagination {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        list-style: none !important;
        padding-left: 0 !important;
        margin: 0 !important;
    }
    .custom-pagination .page-item {
        list-style: none !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    .custom-pagination .page-link {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-width: 38px !important;
        height: 38px !important;
        padding: 0 12px !important;
        border-radius: 10px !important;
        font-size: 0.9rem !important;
        font-weight: 700 !important;
        color: #0A5C45 !important;
        background-color: #FFFFFF !important;
        border: 1px solid #E2E8F0 !important;
        text-decoration: none !important;
        transition: all 0.2s ease !important;
        box-shadow: 0 2px 6px rgba(0,0,0,0.04) !important;
    }
    .custom-pagination .page-link:hover {
        background-color: #0A5C45 !important;
        color: #FFFFFF !important;
        border-color: #0A5C45 !important;
        transform: translateY(-1px) !important;
    }
    .custom-pagination .page-item.active .page-link {
        background-color: #0A5C45 !important;
        color: #FFFFFF !important;
        border-color: #0A5C45 !important;
        box-shadow: 0 4px 12px rgba(10, 92, 69, 0.25) !important;
    }
    .custom-pagination .page-item.disabled .page-link {
        color: #CBD5E1 !important;
        background-color: #F8FAFC !important;
        border-color: #E2E8F0 !important;
        cursor: not-allowed !important;
        box-shadow: none !important;
    }
</style>

<nav class="custom-pagination-container" role="navigation" aria-label="Pagination Navigation">
    <ul class="custom-pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Sebelumnya">&lsaquo;</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Selanjutnya">&rsaquo;</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link" aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </ul>
</nav>
@endif
