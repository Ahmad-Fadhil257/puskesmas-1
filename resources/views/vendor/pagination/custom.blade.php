@if ($paginator->hasPages())
<style>
    .custom-pagination-container {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        width: 100% !important;
        margin: 1.5rem auto !important;
    }
    .custom-pagination {
        display: inline-flex !important;
        justify-content: center !important;
        align-items: center !important;
        gap: 6px !important;
        list-style: none !important;
        padding-left: 0 !important;
        margin: 0 auto !important;
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

    /* ==========================================
       DARK MODE SUPPORT (Admin / Dark Theme)
       ========================================== */
    .dark-style .custom-pagination-container,
    [data-bs-theme="dark"] .custom-pagination-container {
        margin: 1rem auto !important;
        justify-content: center !important;
    }
    .card-footer .custom-pagination-container {
        margin: 0 auto !important;
        width: 100% !important;
        justify-content: center !important;
    }
    .dark-style .custom-pagination .page-link,
    [data-bs-theme="dark"] .custom-pagination .page-link {
        color: #CBD5E1 !important;
        background-color: #0F172A !important;
        border: 1px solid #334155 !important;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.25) !important;
    }
    .dark-style .custom-pagination .page-link:hover,
    [data-bs-theme="dark"] .custom-pagination .page-link:hover {
        background-color: rgba(16, 185, 129, 0.18) !important;
        color: #34D399 !important;
        border-color: #10B981 !important;
        box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2) !important;
        transform: translateY(-1px) !important;
    }
    .dark-style .custom-pagination .page-item.active .page-link,
    [data-bs-theme="dark"] .custom-pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #0A5C45 0%, #059669 100%) !important;
        color: #FFFFFF !important;
        border-color: #10B981 !important;
        box-shadow: 0 4px 14px rgba(10, 92, 69, 0.45) !important;
    }
    .dark-style .custom-pagination .page-item.disabled .page-link,
    [data-bs-theme="dark"] .custom-pagination .page-item.disabled .page-link {
        color: #64748B !important;
        background-color: rgba(15, 23, 42, 0.55) !important;
        border-color: rgba(255, 255, 255, 0.08) !important;
        opacity: 0.55 !important;
        box-shadow: none !important;
        transform: none !important;
        cursor: not-allowed !important;
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
