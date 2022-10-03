<x-frontend.layouts.master>

    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        {{-- @dd($events) --}}
        @foreach ($events as $event)
            <x-frontend.event-card :event=$event />
        @endforeach
    </div>
</x-frontend.layouts.master>