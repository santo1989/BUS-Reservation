<x-frontend.layouts.master>
    {{-- <div class="row">
 
        <div class="col-md-4 mb-5">
            <div class="card h-100">
                @foreach ($event->images as $image)
                    <img class="card-img-top" src="{{ asset('images/events/'.$image) }}" height="180" alt="..." />
                @endforeach --}}
                <!-- Events details-->
            {{-- </div>
        </div>

        <div class="col-md-8 mb-5">
            <div class="card h-100"> --}}

                <!-- Events details-->
                {{-- <div class="card-body p-4">
                    <div class="text-center">
                        <!-- Event name-->
                        <h5 class="fw-bolder">
                            {{ $event->name }}
                        </h5>
                        <p> {{ $event->details }}</p>
                    </div>
                </div> --}}
                <!-- event actions-->
                {{-- <div class="card-footer p-4 pt-0 border-top-0 bg-transparent"> --}}
                    {{-- <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{ route('add_to_cart', ['event'=>$event->id]) }}">Add to cart</a></div> --}}
                {{-- </div>
            </div>
        </div>
    </div>



    @push('css')
        <style>
            body{
                background: skyblue;
            }
        </style>
    @endpush --}}

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                <div class="card m-1 p-1">
                    <div class="card-body" >
                        <div id="imageShow"></div>

                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card m-1 p-1">
                    <div class="card-body">
                        <h3>{{ $event->name }}</h3>
                        <p>{{ $event->details }}</p>
                        
                    </div>
                </div>
            </div>

            <div class="col-md-6 ">
                <div class="row m-1 p-1"> 
                    @foreach ($event->images as $image)
                    {{-- @dd($event) --}}
                  
                    <div class="col-md-4 ">
                          <a href="{{ asset('images/events/'.$image) }}" id="imageShowbyhref">
                        <div class="card m-1 p-1">
                            <div class="card-body  m-1 p-1">
                              <img class="card-img-top" src="{{ asset('images/events/'.$image) }}" height="100" width="100" alt="..." />
                            </div>
                        </div>
                     </a>
                    </div> 
                   
                     @endforeach 
                     <script>
                        let image = document.getElementById('imageShow');
                        let href = document.getElementById('imageShowbyhref');

                        console.log(href);

                        href.addEventListener('click', function(e){
                            e.preventDefault();
                            image.innerHTML = `<img src="${e.target.src}" class="rounded" height="100" width="100" alt="..." />`
                        })



                    </script>
                </div>
            </div>
        </div>
    </div>

    </x-frontend.layouts.master>