<x-frontend.layouts.master>

    <div class="container">
    <div >
        {{-- @dd($events) --}}
        <div class="mb-5">
        <form action="#">
                
            <div class="input-group mb-3" style="padding-right:150px; padding-left:150px;">
                <input type="text" class="form-control"  aria-label="Recipient's username" aria-describedby="button-addon2" name='search'>
                <button class="btn btn-outline-warning " type="submit" id="button-addon2">Search</button>
            
            </div>
        </form>
        </div>
    </div>
    <div class="row justify-content-center" >
        @foreach ($events as $event)
            {{-- <x-frontend.event-card :event="$event" /> --}}
            <div class="col-md-3 col-sm-12 col-xl-3 mb-5" id="card_event">
             <div class="card h-100">
        <!-- event image-->
        @php
            $event->images = json_decode($event->images, true);
        @endphp
        <img class="card-img-top" src="{{ asset('images/events/'.$event->images[0]) }}" height="180" alt="..." />
        <!-- event details-->
        <div class="card-body p-4">
            <div class="text-center">
                <!-- event name-->
                <h5 class="fw-bolder">
                    <a href="{{ route('fleet_details', ['id'=>$event->id]) }}">{{ $event->name }}</a>
                </h5>
                <!-- event reviews-->
                <div class="d-flex justify-content-center small text-warning mb-2">
                    {{-- short description from long description of the event will be here --}}

                    <div class="text-muted">
                        {{ Str::limit($event->details, 50) }}
                    </div>
                </div>
                <!-- event price-->
            </div>
        </div>
        <!-- event footer-->
        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
            <div class="text-center">
                <a class="btn btn-outline-warning mt-auto" href="{{ route('fleet_details', ['id'=>$event->id]) }}">View Details</a>
            </div>
        </div>

    </div>
</div>
        @endforeach
    </div>
    </div>
    <script>
      let search = document.querySelector('input[name="search"]');
      let card_event = document.querySelectorAll('#card_event');
        search.addEventListener('keyup', function(){
            let value = search.value.toLowerCase();
            card_event.forEach(function(card){
            let card_name = card.querySelector('h5').textContent.toLowerCase();
            if(card_name.indexOf(value) != -1){
                card.style.display = 'block';
            }else{
                card.style.display = 'none';
            }
            });
        });
    </script>
    
</x-frontend.layouts.master>