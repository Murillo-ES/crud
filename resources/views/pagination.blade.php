@if ($paginator->hasPages())
    <ul class="pagination center-align">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
        @else
            <li>
                <a href="#" wire:click="previousPage" wire:loading.attr="disabled">
                    <i class="material-icons">chevron_left</i>
                </a>
            </li>
        @endif

        {{-- Page X of Y --}}
        <li class="disabled">
            <a href="#!" class="black-text">Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}</a>
        </li>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="#" wire:click="nextPage" wire:loading.attr="disabled">
                    <i class="material-icons">chevron_right</i>
                </a>
            </li>
        @else
            <li class="disabled"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
        @endif
    </ul>
@endif
