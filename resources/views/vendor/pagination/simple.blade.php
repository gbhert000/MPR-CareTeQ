<div>
    @if($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between pagination pt-2">
            <div class=" max-w-7x justify-between page-paginator my-auto">
                <ul class="pagination flex  prev-next page-paginator">


                    {{-- PREVIOUS --}}
                
                    @if($paginator->onFirstPage())
                        <li class=" active ml-2  px-2 py-1 text-center rounded border shadow  text-white"><span>
                        {{'Previous'}} 

                    </span></li>
                    
                    @else
                    @if(method_exists($paginator,'getCursorName'))
                        <li class="ml-2  px-2 py-1 text-center rounded border shadow  text-white">
                            <button dusk="previousPage" class="text-white" wire:click="setPage('{{e($paginator->previousCursor()->encode())}}','{{e($paginator->getCursorName())}}')" wire:loading.attr="disabled">
                            {{'Previous'}}  

                        </button>
                        </li>
                        
                    @else
                    <li class=" ml-2  px-2 py-1 text-center rounded border shadow text-white">
                        <button wire:click="previousPage('{{e($paginator->getPageName())}}')" class="text-white"wire:loading.attr="disabled" dusk="previousPage{{e($paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName())}}">
                            {{'Previous'}} 

                        </button>
                    </li>
                        
                    @endif
                    @endif
                    {{-- END PREVIOUS --}}
                    {{-- NUMBERS --}}
                    @foreach ($elements as $element)
                        <div class="flex">
                            @if (is_string($element))
                            <li class="page-item disabled" aria-disabled="true"><span class="">{{ $element }}</span></li>
                        @endif
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <li class="page-item active  w-10 px-2 py-1 text-center rounded border shadow  text-white" wire:click="gotoPage({{$page}})">{{$page}}
                                        </li>
                                    @else
                                        <li class=" w-10 px-2 py-1 text-center rounded border shadow  cursor-pointer" wire:click="gotoPage({{$page}})">{{$page}}</li>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    @endforeach
                
                    
                    {{-- NEXT --}}
                    @if($paginator->hasMorePages())
                        @if(method_exists($paginator,'getCursorName'))
                            <li class="mr-2  px-2 py-1 text-center rounded border shadow  text-white">
                               <button dusk="nextPage" class="text-white" wire:click="setPage('{{e($paginator->nextCursor()->encode())}}','{{e($paginator->getCursorName())}}')" wire:loading.attr="disabled" class="\">
                                    {{'Next'}}

                            </button> 
                            </li>
                            
                        @else
                            <li class="mr-2 px-2 py-1 text-center rounded border shadow  text-white">
                                <button class="text-white" wire:click="nextPage('{{e($paginator->getPageName())}}')" wire:loading.attr="disabled" dusk="nextPage{{e($paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName())}}">
                                    {{'Next'}}

                            </button>
                            </li>
                            
                        @endif
                    @else
                        <li  class="active disabled mr-2 page-item px-2 py-1 text-center rounded border shadow bg-blue-500 text-white">
                            <span class="">
                            {{'Next'}}</span> 
                        </li>
                        
                    @endif

                    {{-- END NEXT --}}
                </ul>
            </div>
        </nav>
    @endif


</div><?php /**PATH C:\Users\admin\dplaravel\vendor\livewire\livewire\src\views\pagination/simple-tailwind.blade.php ENDPATH**/ ?>