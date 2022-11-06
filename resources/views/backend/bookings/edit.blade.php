<x-backend.layouts.master>
  <x-slot name="pageTitle">
    Edit Booking
  </x-slot>

  <x-slot name='breadCrumb'>
    <x-backend.layouts.elements.breadcrumb>
        <x-slot name="pageHeader"><span class="badge alert-success">{{ $booking->passenger->name }}</span> - <span class="badge alert-success">{{ $booking->trip->trip_code }}</span></x-slot>
        <li class="breadcrumb-item"><a href="{{ route('bookings.index') }}">Booking</a></li>
        <li class="breadcrumb-item active">Edit Booking</li>
    </x-backend.layouts.elements.breadcrumb>
  </x-slot>

  @if ($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
  @endif

  @if (session('message'))
    <div class="alert alert-success">
        <span class="close" data-dismiss="alert">&times;</span>
        <strong>{{ session('message') }}.</strong>
    </div>
  @endif

  <form action="{{ route('bookings.update', ['booking_id' => $booking->id]) }}" method="post">
    @csrf
    @method('put')

    <div>
      <div class="row mb-3">        
          <div class=col-md-4>
              <label for="passenger_id" class="mt-2">Passengers</label>
              <select name="passenger_id" id="passenger_id" class="form-select">
                  <option value="">Select One...</option>
                  @foreach ($passengers as $passenger)
                      <option value="{{ $passenger->id }}" {{ $passenger->id == $booking->passenger_id ? 'selected' : '' }}>{{ $passenger->name }}</option>
                  @endforeach
              </select>
          </div>

          <div class=col-md-4>
              <label for="event_id" class="mt-2">Event</label>
              <select name="event_id" id="event_id" class="form-select">
                  <option value="">Select One...</option>
                  @foreach ($events as $event)
                      <option value="{{ $event->id }}" {{ $event->id == $booking->event_id ? ' selected' : '' }}>{{ $event->name }}</option>
                  @endforeach
              </select>
          </div>

          <div class=col-md-4>
              <label for="trip_id" class="mt-2">Trip</label>
              <select name="trip_id" id="trip_id" class="form-select">
                  <option value="">Select One...</option>  
                  @foreach ($trips as $trip)
                      <option value="{{ $trip->id }}" {{ $trip->id == $booking->trip_id ? ' selected' : '' }}>{{ $trip->trip_code }} - {{ $trip->available_seats }}</option>
                  @endforeach                      
              </select>
          </div>
      </div> 

      <div class="row mb-3">    
        
          <div class="col-md-4">
              <label for="no_of_seat" class="mt-2"> Number Of Seat</label>
              <input type="number" name="no_of_seat" id="no_of_seat" class="form-control" value="{{ $booking->no_of_seat }}">
          </div>

          <div class=col-md-4>
              <label for="stoppage" class="mt-2">Stoppage</label>
              <select name="stoppage" id="stoppage" class="form-select">
                  <option value="">Select One...</option> 
                  @foreach ($modStoppages as $stoppage)
                      <option value="{{ $stoppage }}" {{ $stoppage == $booking->stoppage ? ' selected' : ''}} >{{ $stoppage }}</option>
                  @endforeach                       
              </select>
          </div>

          <div class="col-md-4 mt-5" id="avail_div">
              <strong>Available seat: <span id="new_available">{{ $booking->trip->available_seats }}</span></strong> 
          </div>
      </div>            
      
      <x-backend.form.button>Save</x-backend.form.button>    
    </div>
  </form>

  <input type="hidden" value="{{ url('') }}" id="base_url">
  
  <script>
      let tripAvailableSeat = '';
      $('#event_id').on('change', function(){
        var event_id = $(this).val();
        const base_url = $("#base_url").val();
        const fethc_url = `${base_url}/get-trips/${event_id}`
        fetch(fethc_url)
        .then(response => response.json())
        .then(data => {
            const tripSelect = document.getElementById('trip_id');
            tripSelect.innerHTML = "";
            const option = document.createElement('option');
            option.value = "";
            option.innerHTML = "Select One...";
            tripSelect.appendChild(option);
            data.map(datam => {
                const option = document.createElement('option');
                option.value = datam.id;
                option.innerHTML = datam.trip_code + " - " + datam.available_seats;
                tripSelect.appendChild(option);
            })
        })
        // alert(fethc_url);
      })

      $('#trip_id').on('change', function(){
        var trip_id = $(this).val();
        const base_url = $("#base_url").val();
        const fethc_url = `${base_url}/get-stoppages/${trip_id}`
        fetch(fethc_url)
        .then(response => response.json())
        .then(data => {
            const stoppagesSelect = document.getElementById('stoppage');
            stoppagesSelect.innerHTML = ""
            const option = document.createElement('option');
            option.value = "";
            option.innerHTML = "Select One...";
            stoppagesSelect.appendChild(option);
            const locations = Object.keys(data);
            const times = Object.values(data);
            const limit = locations.length;
            
            for(let i = 0; i<limit; i++){
                // console.log(locations[i]);
                const option = document.createElement('option');
                option.value = locations[i]+":"+times[i];
                option.innerHTML = locations[i]+":"+times[i];
                stoppagesSelect.appendChild(option);
            }
        })

        const fethc_url_seat = `${base_url}/get-available-seat/${trip_id}`;
        fetch(fethc_url_seat)
        .then(response => response.json())
        .then(data => {
            tripAvailableSeat = data;
            $("#new_available").html(tripAvailableSeat);
        })
      })

      $("#no_of_seat").on('change', function() {
        const selectedSeat = this.value;
        
        const previousBooking = "<?php echo $booking->no_of_seat; ?>";
        
        if(typeof(tripAvailableSeat) =='number')
        {
            let newAvailable = parseInt(tripAvailableSeat) + parseInt(previousBooking) - parseInt(selectedSeat);
            if(newAvailable < 0){
                $("#new_available").attr('class', 'bg-danger p-2');
                $("#new_available").html(newAvailable);
            }else{
                $("#new_available").attr('class', 'bg-warning p-2');
                $("#new_available").html(newAvailable);
            }
        }else{            
            let newAvailable = parseInt(<?php echo $booking->trip->available_seats; ?>) + parseInt(previousBooking) - parseInt(selectedSeat);

            if(newAvailable < 0){
                $("#new_available").attr('class', 'bg-danger p-2');
                $("#new_available").html(newAvailable);
            }else{
                $("#new_available").attr('class', 'bg-warning p-2');
                $("#new_available").html(newAvailable);
            }
        }
      })


    
      
  </script>

</form>

</x-backend.layouts.master>

