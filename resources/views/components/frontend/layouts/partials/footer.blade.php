<footer class="footer py-5" style="background-color: #400859">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4 mb-md-0 text-center text-white">
                <ul class="list-unstyled mb-0">
                    <li><img src="{{ asset('ui/frontend/images/logo_small.png')}}" alt="" class="img-circule" height=100px;></li>
                    
                </ul>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4 mb-md-0 text-center text-white">
                    <h5 class="pb-3">P.O. Box 161<br>
                      SILVER LAKE MN 55381</h5><br>
              <p >US 
                DOT 2140983<br></p>
              <p >MN DOT 382429<br> 
                </p>
                    
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4 mb-md-0 text-center text-white">
                    <h5 class="pb-3">
                        <a class="text-white text-decoration-none" href="{{ route('fleets') }}">Fleet</a><br>
                      <br>
                      <a class="text-white text-decoration-none" href="{{ route('contactUS') }}">Contact Us</a><br>
                      <br>
                      <a class="text-white text-decoration-none" href="#">Get a Quote</a><br>
                      <a class="text-white text-decoration-none" href="#"><br>
                      </a><br>
                      <br>
                    </h5>
                
                    
            </div>
            {{-- <div class="col-lg-3 col-md-6 mb-4 mb-md-0 text-center text-white">
                
            </div> --}}

    </div>

   
    
    <div class="footer-lower"> 
        <div class="media-container-row"> 
          <div class="col-sm-12"> 
            <hr>
          </div>
        </div>
        <div class="media-container-row mbr-white">
          <div class="row">
             
          <div class="col-sm-12"> 

            <p class="text-white text-decoration-none d-flex justify-content-between"> © Copyright 2018-{{ now()->year }} Phantom Tranzit LLC- All Rights Reserved 
            
            <a class="text-white text-decoration-none d-flex justify-content-between" href="https://breakitsolution.com/" traget="blank">Developed By: Break-IT</a>
          </p> </div>
          </div>
        </div>
      </div>
</footer>