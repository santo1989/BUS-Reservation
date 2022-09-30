<x-backend.layouts.master>
    <x-slot name="pageTitle">
       Create Booking
    </x-slot>

    <x-slot name='breadCrumb'>
      <x-backend.layouts.elements.breadcrumb>
          <x-slot name="pageHeader"> Booking </x-slot>
          <li class="breadcrumb-item"><a href="{{ route('bookings.index') }}">Role</a></li>
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
          <div class="row m-4">
              <div class="col-sm-6">
              <!-- text input -->
             
        <div class="row">        
            <div class=col-md-4>
                <label for="passenger_id" class="mt-2">Passenger</label>
                <select name="passenger_id" id="passenger_id" class="form-select">
                    <option value="">Select One...</option>
                    @foreach ($passangers as $passenger)
                        <option value="{{ $passenger->id }}">{{ $passenger->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">        
            <div class=col-md-4>
                <label for="event_id" class="mt-2">Events</label>
                <select name="event_id" id="event_id" class="form-select" onchange="tripList()">
                    <option value="">Select One...</option>
                    @foreach ($events as $event)
                        <option value="{{ $event->id }}">{{ $event->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">        
            <div class=col-md-4>
                <label for="trip_id" class="mt-2">Trips</label>
                <select name="trip_id" id="trip_id" class="form-select">
                    <option value="">Select One...</option>
                </select>
            </div>
        </div>
        
              </div>
          </div>
          <button type="submit" class="btn btn-primary" style="margin-left: 33px">Save</button>
      </div>
    </form>
    <script>
        function tripList()
        {
            var trips = {!!$trips!!};
            var eventId = document.getElementById('event_id').value;
            const select = document.getElementById('trip_id');

            for (trip of trips)
            {
                if(trip.event_id == eventId)
                {
                    const option = document.createElement('option');
                    option.value = trip.id;
                    option.innerHTML = trip.trip_details;
                    select.appendChild(option);
                    //console.log("appended");
                }
            }
  
        
       // console.log(trips);
       // console.log(eventId);
        
        }
       
    </script>


</x-backend.layouts.master>


