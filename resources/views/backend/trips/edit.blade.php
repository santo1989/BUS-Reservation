<x-backend.layouts.master>
  <x-slot name="pageTitle">
    Edit Trip
 </x-slot>

 <x-slot name='breadCrumb'>
   <x-backend.layouts.elements.breadcrumb>
       <x-slot name="pageHeader"> Trip </x-slot>
       <li class="breadcrumb-item"><a href="{{ route('trips.index') }}">Trip</a></li>
       <li class="breadcrumb-item active">Edit Trip</li>
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
{{-- <form action="{{ route('roles.update') }}" method="post"> --}}
<form action="{{ route('trips.update', ['trip_id' => $trip->id]) }}" method="post">
<div>
@csrf
  <div class="row m-4">
      <div class="col-sm-6">
          {{-- <input type="text" class="form-control" placeholder="Enter role Name" name="name" value="{{ old('name', $role->name ) }}"> --}}
   
      <x-backend.form.input name="trip_details" type="textarea" label="Trip Details" value="{{ old('name', $trip->trip_details ) }}"/>
      <x-backend.form.input name="start_date" type="date" label="Start Date" value="{{ old('name', $trip->start_date ) }}"/>
      <x-backend.form.input name="end_date" type="date" label="End Date" value="{{ old('name', $trip->end_date ) }}"/>
      <x-backend.form.input name="start_location" type="text" label="Start Location" value="{{ old('name', $trip->start_location ) }}"/>
      <x-backend.form.input name="end_location" type="text" label="End Location" value="{{ old('name', $trip->end_location ) }}"/>

      <label for="event_id" class="mt-2">Event</label>
      <select name="event_id" id="event_id" class="form-select">
          @foreach ($events as $event)
              <option value="{{ $event->id }}"
                @if ($event->id  == old('name', $trip->event->id))
                    selected="selected"
                @endif
              
                >{{ $event->name }}</option>
          @endforeach
      </select>

      <label for="bus_id" class="mt-2">Bus</label>
      <select name="bus_id" id="bus_id" class="form-select">
          @foreach ($buses as $bus)
              <option value="{{ $bus->id }}"
                @if ($bus->id  == old('name', $trip->bus->id))
                selected="selected"
               @endif
                >{{ $bus->name }}</option>
          @endforeach
      </select>

      <label for="drivers_id" class="mt-2">Driver</label>
      <select name="drivers_id" id="drivers_id" class="form-select">
          @foreach ($drivers as $driver)
              <option value="{{ $driver->id }}"
                @if ($driver->id  == old('name', $trip->driver->id))
                selected="selected"
               @endif
                >{{ $driver->name }}</option>
          @endforeach
      </select>
      
      <div class="form-group" id="stoppages">
          <label for="stoppages">Stopagges</label>
          <div class="d-flex">
              <input name="stoppages[]" class="form-control" id="stoppages" type="text">
              <a class="bg-warning d-flex align-items-center justify-content-center bordered rounded ml-1" style="width: 40px; color: purple" onclick="createInput()"><i class="fa fa-plus"></i></a>
          </div>
      </div>
      </div>
      
  </div>
  <button type="submit" class="btn btn-primary" style="margin-left: 33px">Save</button>
</div>
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

  let deleteDiv = (e) => {
            e.parentNode.parentNode.removeChild(e.parentNode);
            // console.log(e);
        }
  
      
</script>

</x-backend.layouts.master>

