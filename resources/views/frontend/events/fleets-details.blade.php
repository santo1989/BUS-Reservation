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
                <div class="row "> 
                    @foreach ($event->images as $image)
                    {{-- @dd($event) --}}
                    <div class="col-md-4 ">
                         
                        <div class="card m-1 p-1">
                            <div class="card-body  m-1 p-1  " data-toggle='modal' data-target='#staticBackdrop' id="modalBtn">
                              <img class="card-img-top" src="{{ asset('images/events/'.$image) }}" height="100" width="100" alt="..." />
                            </div>
                        </div>
                    
                    </div> 
                   
                     @endforeach 
                     
                </div>
            </div>
        </div>
        <div class="modal" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop" aria-hidden="false">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" >
                
              </div>
               
            </div>
          </div>
        </div>
    </div>
    
        

        <script>
            let images = document.querySelectorAll('.card-img-top');
            let modalBtn = document.querySelector('#modalBtn');

            let modal = document.querySelector('#staticBackdrop');
            let modalBody = document.querySelector('.modal-body');
            let modalTitle = document.querySelector('.modal-title');
            let firstImg = document.querySelector('#firstimg');
            let imageShow = document.querySelector('#imageShow');
            let modalImg = document.createElement('img');
            modalImg.setAttribute('class', 'card-img-top');
            modalImg.setAttribute('height', '300');
            modalImg.setAttribute('width', '100%');
            modalImg.setAttribute('alt', '...');
            modalImg.setAttribute('id', 'modalImg');
            modalBody.appendChild(modalImg);
            modalImg.src = firstImg.src;
            modalTitle.innerHTML = firstImg.alt;
            modalBody.style.display = 'none';
            modal.style.display = 'none';
            modalBtn.addEventListener('click', function(){
                modal.style.display = 'block';
                modalBody.style.display = 'block';
            });
            images.forEach(function(image){
                image.addEventListener('click', function(){
                    modalImg.src = image.src;
                    modalTitle.innerHTML = image.alt;
                });
            });


          
            




            
            


            </script>
        



    </x-frontend.layouts.master>