<x-frontend.layouts.master>

    <div >
        {{-- @dd($events) --}}
        <div class="mb-5">

            <div class="input-group mb-3" style="padding-right:150px; padding-left:150px;">
                <input type="text" class="form-control"  aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-warning " type="button" id="button-addon2">Search</button>
            </div>

        </div>
    </div>
    <div style="padding-right:50px; padding-left:50px;">
    @foreach ($events as $event)
    <!-- <x-frontend.event-card :event=$event /> -->
    @endforeach
    </div>
    </div>
</x-frontend.layouts.master>