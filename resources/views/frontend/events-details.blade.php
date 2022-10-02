<x-frontend.layouts.master>
    <div class="row">
        {{-- @dd($event) --}}
        <div class="col-md-4 mb-5">
            <div class="card h-100">
                <img class="card-img-top" src="{{ asset('images/events/'.$images) }}" height="180" alt="..." />
                <!-- Events details-->
            </div>
        </div>

        <div class="col-md-8 mb-5">
            <div class="card h-100">

                <!-- Events details-->
                <div class="card-body p-4">
                    <div class="text-center">
                        <!-- Event name-->
                        <h5 class="fw-bolder">
                            {{ $event->name }}
                        </h5>
                        <p> {{ $event->details }}</p>
                    </div>
                </div>
                <!-- event actions-->
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    {{-- <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{ route('add_to_cart', ['event'=>$event->id]) }}">Add to cart</a></div> --}}
                </div>
            </div>
        </div>
    </div>



    @push('css')
        <style>
            body{
                background: skyblue;
            }
        </style>
    @endpush

    </x-frontend.layouts.master>