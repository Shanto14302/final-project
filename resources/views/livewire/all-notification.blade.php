<div wire:poll>
        @php
            $total = 0;
            if (Auth::user()->role==1) {
                $resetTotal = $resetAll->count();
                $total = $resetTotal;
            }
            
        @endphp
        @if ($total>0)
        <span  class="badge badge-danger ml-2 mt-2">{{ $total }}</span>
        
        @endif
</div>

