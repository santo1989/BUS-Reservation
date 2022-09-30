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
            <div class="row mb-3">        
                <div class=col-md-4>
                    <label for="passenger_id" class="mt-2">Passengers</label>
                    <select name="passenger_id" id="passenger_id" class="form-select">
                        <option value="">Select One...</option>
                        @foreach ($passengers as $passenger)
                            <option value="{{ $passenger->id }}">{{ $passenger->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class=col-md-4>
                    <label for="event_id" class="mt-2">Event</label>
                    <select name="event_id" id="event_id" class="form-select">
                        <option value="">Select One...</option>
                        @foreach ($events as $event)
                            <option value="{{ $event->id }}">{{ $event->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class=col-md-4>
                    <label for="trip_id" class="mt-2">Trip</label>
                    <select name="trip_id" id="trip_id" class="form-select">
                        <option value="">Select One...</option>                        
                    </select>
                </div>
            </div> 

            <div class="row mb-3">        
                <div class=col-md-4>
                    <label for="stoppage" class="mt-2">Stoppage</label>
                    <select name="stoppage" id="stoppage" class="form-select">
                        <option value="">Select One...</option>                        
                    </select>
                </div>
            </div>            
            
            <x-backend.form.button>Save</x-backend.form.button>    
        </div>
    </form>

    <input type="hidden" value="{{ url('') }}" id="base_url">
    
    <script>
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
                    option.innerHTML = datam.trip_code;
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
        })
    </script>     


</x-backend.layouts.master>


