@props(['event'])

<div class="col mb-5">
    <div class="card h-100">
        {{-- @dd($event) --}}
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
                        {{ $event->details }}
                </div>
                <!-- event price-->
            </div>
        </div>
        <!-- event actions-->
        {{-- <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
        </div> --}}
    </div>
</div>