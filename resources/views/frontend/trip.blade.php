        <x-frontend.layouts.master>

        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

        <p class="text-center"
        style="padding-top:10px; padding-bottom:20px; font-family: 'Inconsolata', monospace;  font-size: 25px;
            letter-spacing: 1px; border: 2px solid black">TAKE A TRIP</p>
        <table class="table table-dark table-striped">
        <thead>
        <!-- <tr>
        <th scope="col">Book a Seat</th>
        </tr> -->
        </thead>
        <tbody>
           @foreach ($trips as $index => $trip)
        <tr>


        <td>
        <p class="d-flex justify-content-between">
        <a>{{ $trip->trip_code }}</a>
        <a class="btn btn-outline-light" data-bs-toggle="collapse" href="#multiCollapseExample1"
        role="button" aria-expanded="false" aria-controls="multiCollapseExample1" >Book Now</a>
        </p>
        <div class="row">
        <div class="col">
        <div class="collapse multi-collapse" id="multiCollapseExample1">
        <div class="card card-body">
        <table class="table">
        <thead>
        <tr>
        <th scope="col">SL</th>
        <th scope="col">Trip Code</th>
        <th scope="col">Start Date</th>
        <th scope="col">End Date</th>
        <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <tr>
              @forelse ($trips as $index => $trip)
                <tr>
                  <th scope="row">{{ $index+1 }}</th>
                  <th>{{ $trip->trip_code }}</th>
                  <td>{{ $trip->start_date }}</td>
                  <td>{{ $trip->end_date }}</td> 
                    <!-- Button trigger modal -->
                    
                  <td>
                     @if (Route::has('login'))
                   @auth
                   <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="myfunction(<?php echo $trip->id;  ?>)">Book a Seat</button>
                  @else
                   <a type="button" class="btn btn-sm btn-warning" href="{{ route('login') }}" >Book a Seat</a>
                   @endauth
                  </td>
                  @endif
                
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center">No Trips Found</td>
                </tr>
              @endforelse
              @endforeach
        </td>


        <!-- Modal -->


        <div class="modal fade bd-example-modal-lg" tabindex="-1"
        role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-lg">
        <div class="modal-content text-dark">
        <div class="modal-header">
        <h5 class="modal-title " id="bd-example-modal-lg">Trip Booking
        </h5>
         <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{ route('newBooking') }}" method="POST">
        @csrf

        {{-- hidden --}}
         @forelse ($trips as $index => $trip)
        <input type="hidden" name="trip_id" id="trip_id" value="<?php echo $trip->id;  ?>">
        @empty
        <tr>
        <td colspan="5" class="text-center">No Trips Found</td>
        </tr>
        @endforelse

        {{-- <form action="" method="POST"> --}}
        <div class="container-fluid">
        <div class="row">
        <div
        class="col-md-4 col-sm-6 col-lg-4">
        <div class="mb-3 text-dark">
        <label
        for="exampleFormControlInput1"
        class="form-label  tex-dark">Passenger
        Name</label>
        <input type="text"
        class="form-control"
        id="exampleFormControlInput1" name="name">

        </div>
        </div>
        <div
        class="col-md-4 col-sm-6 col-lg-4">
        <div class="mb-3 text-dark">
        <label
        for="exampleFormControlInput1"
        class="form-label  tex-dark">Phone
        Number</label>
        <input type="text"
        class="form-control"
        id="exampleFormControlInput1" name="phone">

        </div>
        </div>
        <div
        class="col-md-4 col-sm-6 col-lg-4">
        <div class="mb-3 text-dark">
        <label
        for="exampleFormControlInput1"
        class="form-label  tex-dark">Address</label>
        <input type="textarea"
        class="form-control"
        id="exampleFormControlInput1" name="address">

        </div>
        </div>
        </div>
        <div class="row">
        <div
        class="col-md-4 col-sm-6 col-lg-4">
        <div class="mb-3 text-dark">
        Events
        <select class="form-select"
        aria-label="Default select example" name="event_id" >
        @forelse ( $events_name as $events)
          
        <option value="{{ $events->id }}">{{ $events->name }}</option>
        @empty
        <option value="0">No Event Found</option>
        @endforelse
      
        </select>
        </div>
        </div>
        <div
        class="col-md-4 col-sm-6 col-lg-4">
        <div class="mb-3 text-dark">
        Trips
        <select class="form-select"
        aria-label="Default select example" name="trip_id">
        @forelse ( $trips as $trip)

        <option value="{{ $trip->id }}">{{ $trip->trip_code }}</option>
        @empty
        <option value="0">No Trip Found</option>
        @endforelse

        </select>
        </div>
        </div>

        <div
        class="col-md-4 col-sm-6 col-lg-4">
        <div class="mb-3 text-dark">
        Stoppages
        <select class="form-select"
        aria-label="Default select example" name="stoppage">
        @forelse ( $trips as $trip)
        @foreach ( $trip->stoppages as $key => $value)
        <option value="{{ $value }}">{{ $key .'-'. $value }}</option>  
        @endforeach
        @empty
        <option value="0">No Stoppage Found</option>
        @endforelse
        </select>
        </div>
        </div>
        
        </div>
        <div class="row">
        <div
        class="col-md-4 col-sm-6 col-lg-4" id="new_seat_Data">
        <div class="mb-3 text-dark" >
        Number of Seats
        <input type="number" min="1"  class="form-control" id="available_seats_old" name="no_of_seat">  
        </div>
       @php
        $seat = 0;
        $seat = $trip->available_seats;
        $seat = $seat - $trip->booked_seats;
        @endphp
        </div>
        <div
        class="col-md-4 col-sm-6 col-lg-4" id="available_seats">

        </div>
        </div>


        </div>
        
        </div>  
       
        <div class="modal-footer">
        {{-- <button type="button"
        class="btn btn-secondary"
        data-bs-dismiss="modal">Close</button> --}}
        
        <button type="submit"
        class="btn btn-primary" id="bookDta">Booking Confirm</button>
        

        </div>
  </form> 
        </td>
        </tr>
        </tbody>
        </table>
        </div>
        </div>
        </div>
        </div>
        </td>

        </tr>

        </tbody>
        </table>
        </div>
 
        <script>
          let seat = <?php echo $seat; ?>;
          let seat_old = document.getElementById('available_seats_old');
          seat_old.addEventListener('change', function(){
            if(seat_old.value > 0 && seat_old.value <= seat){
              let seat_new = seat - seat_old.value;
            let p = document.createElement('p');
            p.innerHTML = 'Only '+seat_new+' seats are available';
            
            document.getElementById('new_seat_Data').appendChild(p);
            }
            else
            {
              alert('Please enter valid number of seats');
              document.getElementById('new_seat_Data').removeChild(p);
            }
            
          });

          // let bookDta = document.getElementById('bookDta');
          // bookDta.addEventListener('click', function(){
          //   let url = "{{ route('newBooking') }}";
          //   fetch(url){
          //     method: 'POST',
          //     headers: {
          //       'Content-Type': 'application/json'
          //     },
          //     body: JSON.stringify({
          //       name: name,
          //       phone: phone,
          //       address: address,
          //       event_id: event_id,
          //       trip_id: trip_id,
          //       stoppage: stoppage,
          //       no_of_seat: no_of_seat
          //     })
          //   }
          // });
        
        </script>

        </x-frontend.layouts.master>


