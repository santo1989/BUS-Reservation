<x-backend.layouts.master>
    <x-slot name="pageTitle">
       Create Booking
    </x-slot>

    <x-slot name='breadCrumb'>
      <x-backend.layouts.elements.breadcrumb>
          <x-slot name="pageHeader"> Booking </x-slot>
          <li class="breadcrumb-item"><a href="{{ route('bookings.index') }}">Booking</a></li>
          <li class="breadcrumb-item active">Create Booking</li>
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

    <form action="{{ route('bookings.store') }}"  method="post">
        <div>
            @csrf
            <div class="row mb-3">        
                <div class=col-md-4>
                    <label for="passenger_id" class="mt-2">Passengers</label>
                    <select name="passenger_id" id="passenger_id" class="form-select" required>
                        <option value="">Select One...</option>
                        @foreach ($passengers as $passenger)
                            <option value="{{ $passenger->id }}">{{ $passenger->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class=col-md-4>
                    <label for="event_id" class="mt-2">Event</label>
                    <select name="event_id" id="event_id" class="form-select" required>
                        <option value="">Select One...</option>
                        @foreach ($events as $event)
                            <option value="{{ $event->id }}">{{ $event->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class=col-md-4>
                    <label for="trip_id" class="mt-2">Trip</label>
                    <select name="trip_id" id="trip_id" class="form-select" required>
                        <option value="">Select One...</option>                        
                    </select>
                </div>
            </div> 

            <div class="row mb-3"> 
                
                <div class="col-md-4">
                    <label for="no_of_seat" class="mt-2"> Number Of Seat</label>
                    <input type="number" name="no_of_seat" id="no_of_seat" class="form-control" required>
                </div>

                <div class=col-md-4>
                    <label for="stoppage" class="mt-2">Stoppage</label>
                    <select name="stoppage" id="stoppage" class="form-select" required>
                        <option value="">Select One...</option>                        
                    </select>
                </div>

                <div class="col-md-4 mt-5" style="display:none;" id="avail_div">
                    <strong>Available seat: <span id="new_available"></span></strong> 
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
                    option.innerHTML = `${datam.trip_code} - ${datam.available_seats}`;
                    tripSelect.appendChild(option);
                })
            })
            // alert(fethc_url);
        })

        $('#trip_id').on('change', function(){
            var trip_id = $(this).val();
            const base_url = $("#base_url").val();
            const fethc_url = `${base_url}/get-stoppages/${trip_id}`;
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
                $("#avail_div").show();
                $("#new_available").html(tripAvailableSeat);
            })
        })

        $("#no_of_seat").on('change', function() {
            $("#avail_div").show();
            
            
            const selectedSeat = this.value;
            // alert(selectedSeat);
            const newAvailable = parseInt(tripAvailableSeat) - parseInt(selectedSeat);
            if(newAvailable < 0){
                $("#new_available").attr('class', 'bg-danger p-2');
                $("#new_available").html(newAvailable);
            }else{
                $("#new_available").attr('class', 'bg-warning p-2');
                $("#new_available").html(newAvailable);
            }
            // alert(newAvailable);
        })
    </script>     


</x-backend.layouts.master>


