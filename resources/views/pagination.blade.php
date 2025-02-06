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

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled"><a href="#!">{{ $element }}</a></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active blue darken-4"><a href="#!">{{ $page }}</a></li>
                    @else
                        <li>
                            <a href="#" wire:click="gotoPage({{ $page }})" wire:loading.attr="disabled">
                                {{ $page }}
                            </a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

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
