<x-frontend.layouts.master>

 <x-backend.layouts.elements.message :fmessage="session('message')" />
    <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Booking</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('updateBooking', ['id'=> $booking->id]) }}" method="post" enctype="multipart/form-data">
                             @csrf
                             @method('put')
                                <div class="row">
                                    <div class="col-md-6">
                                     <label for="no_of_seat">No of Seat</label>
                                    <input type="number" name="no_of_seat" id="no_of_seat" class="form-control" value="{{ $booking->no_of_seat }}">

                                    </div>
                                   
                                    <div class="col-md-6" id="available_seats">
                                        
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="stoppages">Shuttle Time</label>
                                    <select name="stoppages" id="stoppages" class="form-control">
                                        @php
                                            // $stoppages = explode(',', $booking->trip->stoppages);
                                            $stoppages = json_decode($booking->trip->stoppages);

                                            // dd($stoppages);

                                        @endphp
                                        {{-- @foreach ($stoppages as $stoppage)
                                            <option value="{{ $stoppage }}" {{ $stoppage == $booking->stoppages ? 'selected' : '' }}>{{ $stoppage }}</option>
                                        @endforeach --}}
                                        @foreach ($stoppages as $key => $stoppage)
                                            <option value ="{{ $key }}-{{ $stoppage }}" {{ $key == $booking->stoppages ? 'selected' : '' }}> {{ $key }}-{{ $stoppage }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <input type="hidden" name="trip_id" id="trip_id" value="{{ $booking->trip->id }}">
                                <br>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
            @foreach ($trips as $trip)

            @php
                $seat = 0;
                $seat = $trip->available_seats;
                $seat = $seat - $trip->booked_seats;   
                //   dd($seat);
            @endphp
            @endforeach      
  <script>
        
       let seat = <?php echo $seat; ?>;
          let seat_old = document.getElementById('no_of_seat');
          let newSeat = document.getElementById('available_seats').innerHTML = " ";
          newSeat = document.getElementById('available_seats').innerHTML = ` <div class="rounded bg-success text-white p-2 mt-4">Available Seats: ${seat}</div>`;
          seat_old.addEventListener('change', function(){
            if(seat_old.value > 0 && seat_old.value <= seat){
              let seat_new = seat - seat_old.value;
              if(seat_new <6){
                newSeat = document.getElementById('available_seats').innerHTML = ` <div class="rounded bg-danger text-white p-2 mt-4">Available Seats: ${seat_new}</div>`;
              }else{
                newSeat = document.getElementById('available_seats').innerHTML = ` <div class="rounded bg-success text-white p-2 mt-4">Available Seats: ${seat_new}</div>`;
              }
            }
            else
            {
              alert('Please enter valid number of seats');
            //   document.getElementById('available_seats').removeChild(p);
            document.getElementById('available_seats').innerHTML = " ";
            }
            
          });

    </script>
    </x-frontend.layouts.master>