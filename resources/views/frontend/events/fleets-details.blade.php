<x-frontend.layouts.master>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                
                <div class="card m-1 p-1" id="imageShow">
                    <img class="card-img-top" src="{{ asset('images/events/'.$event->images[0]) }}" height="300" width="100%" alt="..."  id="firstimg"/>
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
                         
                        <div class="card m-1 p-1">
                            <div class="card-body  m-1 p-1">
                              <img class="card-img-top" src="{{ asset('images/events/'.$image) }}" height="100" width="100" alt="..." />
                            </div>
                        </div>
                    
                    </div> 
                   
                     @endforeach 
                     <script>
                        let images = document.querySelectorAll('.card-img-top');
                        let imageShow = document.querySelector('#imageShow');
                        let firstimg = document.getElementById('firstimg');
                        images.forEach((image)=>{
                            image.addEventListener('click',()=>{
                                imageShow.innerHTML = `<img src="${image.src}" height="300" width="100%" alt="">`
                            })
                        })

                        </script>
                </div>
            </div>
        </div>
    </div>

    </x-frontend.layouts.master>