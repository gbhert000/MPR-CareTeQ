@if ($paginator->hasPages())
    <nav class="d-flex justify-items-center pt-2">
        <div class=" max-w-7x justify-between page-paginator my-auto">
            <ul class="pagination flex justify-content-between  prev-next page-paginator">
                {{-- Previous Page Link --}}
                
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled ml-2" id="disabled-but" aria-disabled="true">
                        <span class="page-link">@lang('pagination.previous')</span>
                    </li>
                @else
                    <li class="page-item ml-2">
                        <a class="page-link" href="dashboard?page={{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
                    </li>
                @endif

                <div class="">

                    <div>  
                        <ul class="pagination float-left justify-between pages">
                            {{-- Previous Page Link --}}

        
                            {{-- Pagination Elements --}}
                            @foreach ($elements as $element)
                                {{-- "Three Dots" Separator --}}
                                @if (is_string($element))
                                    <li class="page-item disabled float-left" aria-disabled ="true"><span class="page-link">{{ $element }}</span></li>
                                @endif
        
                                {{-- Array Of Links --}}
                                @if (is_array($element))
                                    @foreach ($element as $page => $url)
                                        @if ($page == $paginator->currentPage())
                                            <li class="page-item active float-left" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                                        @else
                                            <li class="page-item float-left"><a class="page-link" href="dashboard?page={{ $page }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
        
                            {{-- Next Page Link --}}
                    
                        </ul>
                    </div>
                </div>

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item mr-2">
                        <a class="page-link" href="dashboard?page={{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
                    </li>
                @else
                    <li class="page-item disabled mr-2" id="disabled-but" aria-disabled="true">
                        <span class="page-link">@lang('pagination.next')</span>
                    </li>
                @endif
            </ul>
        </div>

        
    </nav>
@endif
