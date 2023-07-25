<div wire:poll>
    <p id="pn{{ $resets->count() }}" class="font-size-12 mb-0  badge badge-danger text-white"><i class="mdi mdi-clock-outline"></i> &nbsp;{{ $resets->count()<1 ? "No Notification" : $resets->count() }}</p>

       
        {{-- <script>
           $( document ).ready(function() {
                console.log( "ready!" );
            });
        </script> --}}
</div>
