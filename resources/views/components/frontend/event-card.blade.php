@props(['event'])

<div class="col mb-5">
    <div class="card h-100">
        {{-- @dd($event) --}}
        <!-- event image-->
        <img class="card-img-top" src="{{ asset('storage/events/'.$event->images) }}" height="180" alt="..." />
        <!-- event details-->
        <div class="card-body p-4">
            <div class="text-center">
                <!-- event name-->
                <h5 class="fw-bolder">
                    <a href="{{ route('event_details', ['id'=>$event->id]) }}">{{ $event->name }}</a>
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