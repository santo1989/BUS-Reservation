<x-backend.layouts.master>

   
    <x-slot name="pageTitle">
       Set Plane
            
    </x-slot>

    <x-slot name='breadCrumb'>
      <x-backend.layouts.elements.breadcrumb>
          <x-slot name="pageHeader"> Plane </x-slot>
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="#">Plane</a></li>
          <li class="breadcrumb-item active">Set Plane</li>
      </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    {{-- dynamic bus set booking using griphic and javascript --}}

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6" id="left">
                </div>
                <div class="col-md-6" id="right">
                </div>
                <div class="col-md-12" id="last" >
                </div>
            </div>
            
        </div>
    </div>

    <script>
        let last = 5;
        let left_side = 2;
        let right_side = 3;
        let total_seat = 29;
        let avalable = total_seat-last;
        
        let working_seat = avalable/(left_side+right_side);
        let left = (working_seat/2);
        let right = (working_seat/2);

        console.log(avalable,working_seat,left,right);
        


        let left_seat = document.getElementById('left');
        let right_seat = document.getElementById('right');
        let last_seat = document.getElementById('last');

        


        

        













    </script>

   
















    </x-backend.layouts.master>


