<x-backend.layouts.master>
    <x-slot name="pageTitle">
       Create Trip
    </x-slot>

    <x-slot name='breadCrumb'>
      <x-backend.layouts.elements.breadcrumb>
          <x-slot name="pageHeader"> Bus </x-slot>
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('trips.index') }}">Trip</a></li>
          <li class="breadcrumb-item active">Create Trip</li>
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
  <form action="{{ route('trips.store') }}"  method="post">
    <div>
        @csrf

        <x-backend.form.input name="trip_details" type="textarea" label="Trip Details"/>
        <x-backend.form.input name="start_date" type="date" label="Start Date"/>
        <x-backend.form.input name="end_date" type="date" label="End Date"/>
        <x-backend.form.input name="start_location" type="text" label="Start Location"/>
        <x-backend.form.input name="end_location" type="text" label="End Location"/>

        <label for="event_id" class="mt-2">Event</label>
        <select name="event_id" id="event_id" class="form-select">
            @foreach ($events as $event)
                <option value="{{ $event->id }}">{{ $event->name }}</option>
            @endforeach
        </select>

        <label for="bus_id" class="mt-2">Bus</label>
        <select name="bus_id" id="bus_id" class="form-select">
            @foreach ($buses as $bus)
                <option value="{{ $bus->id }}">{{ $bus->name }}</option>
            @endforeach
        </select>

        <label for="drivers_id" class="mt-2">Driver</label>
        <select name="drivers_id" id="drivers_id" class="form-select">
            @foreach ($drivers as $driver)
                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
            @endforeach
        </select>
        
        <div class="form-group" id="stoppages">
            <label for="stoppages">Stopagges</label>
            <div class="d-flex">
                <input name="stoppages[]" class="form-control" id="stoppages" type="text">
                <a class="bg-warning d-flex align-items-center justify-content-center bordered rounded ml-1" style="width: 40px; color: purple" onclick="createInput()"><i class="fa fa-plus"></i></a>
            </div>
        </div>
        <x-backend.form.button>Save</x-backend.form.button>    </div>

</form>
<script>

    const createInput = () => {
        const parent = document.getElementById("stoppages");
        const div = document.createElement("div");
        div.setAttribute('class', 'd-flex mt-2');

        const input = document.createElement("input");
        input.setAttribute("type", "text");
        input.setAttribute("class", "form-control");
        input.setAttribute("name", "stoppages[]");

        const aPlus = document.createElement("a");
        aPlus.setAttribute("class", "bg-warning d-flex align-items-center justify-content-center bordered rounded ml-1");
        aPlus.setAttribute("style", "width: 40px; color: purple");
        aPlus.setAttribute("onclick", "createInput()");
        
        const iPlus = document.createElement("i");
        iPlus.setAttribute("class", "fa fa-plus");

        const aDelete = document.createElement("a");
        aDelete.setAttribute("class", "bg-danger d-flex align-items-center justify-content-center bordered rounded ml-1");
        aDelete.setAttribute("style", "width: 40px; color: black");
        aDelete.setAttribute("onclick", "deleteDiv()");
        
        const iDelete = document.createElement("i");
        iDelete.setAttribute("class", "fa fa-trash");


        aPlus.appendChild(iPlus);
        aDelete.appendChild(iDelete);
        div.appendChild(input);
        div.appendChild(aPlus);
        div.appendChild(aDelete);
        parent.appendChild(div);
    }

    const deleteDiv = () => {
        alert("Need to be done");
    }
    
        
</script>



</x-backend.layouts.master>


