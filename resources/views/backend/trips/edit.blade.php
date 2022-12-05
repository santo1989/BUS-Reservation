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
            <div class="row">
                <div class="col-sm-6">
                    {{-- <input type="text" class="form-control" placeholder="Enter role Name" name="name" value="{{ old('name', $role->name ) }}"> --}}

                    <x-backend.form.input name="trip_details" type="textarea" label="Trip Details"
                        value="{{ old('name', $trip->trip_details) }}" />
                </div>

                <div class="col-md-6">
                    <label for="event_id">Event</label>
                    <select name="event_id" id="event_id" class="form-select">
                        @foreach ($events as $event)
                            <option value="{{ $event->id }}"
                                @if ($event->id == old('name', $trip->event->id)) selected="selected" @endif>{{ $event->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <x-backend.form.input name="start_date" type="date" label="Start Date"
                        value="{{ old('name', $trip->start_date) }}" />
                </div>
                <div class="col-md-6">
                    <x-backend.form.input name="end_date" type="date" label="End Date"
                        value="{{ old('name', $trip->end_date) }}" />
                </div>
                {{-- <x-backend.form.input name="start_location" type="text" label="Start Location" value="{{ old('name', $trip->start_location ) }}"/> --}}
                {{-- <x-backend.form.input name="end_location" type="text" label="End Location" value="{{ old('name', $trip->end_location ) }}"/> --}}

                <div class="col-md-6">

                    <label for="bus_id" >Bus</label>
                    <select name="bus_id" id="bus_id" class="form-select">
                        @foreach ($buses as $bus)
                            <option value="{{ $bus->id }}"
                                @if ($bus->id == old('name', $trip->bus->id)) selected="selected" @endif>{{ $bus->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="drivers_id" >Driver</label>
                    <select name="drivers_id" id="drivers_id" class="form-select">
                        @foreach ($drivers as $driver)
                            <option value="{{ $driver->id }}"
                                @if ($driver->id == old('name', $trip->driver->id)) selected="selected" @endif>{{ $driver->name }}
                            </option>
                        @endforeach
                    </select>
                </div>


            </div>
            <div class="form-group mt-3" id="stoppage">
                @foreach ($trip->stoppages as $key => $value)

                
                
                    <div class="d-flex justify-content-between align-items-center">
                        <div style="width: 48%;">
                            <label for="stoppages">Stopagges</label>
                            <input name="stoppages[]" class="form-control" id="stoppages" type="text"
                                value={{ $key }}>
                        </div>
                        <div style="width: 48%;">
                            <label for="times">Expected Time</label>
                            <input name="times[]" class="form-control" id="times" type="time"
                                value="{{ $value }}">
                        </div>
                        {{-- <a class="bg-warning d-flex align-items-center justify-content-center bordered rounded ml-1"
                            style="width: 40px; height: 38px; color: purple; margin-top: 27px;"
                            onclick="createInput()"><i class="fa fa-plus"></i></a>
                        <a class="bg-danger d-flex align-items-center justify-content-center bordered rounded ml-1"
                            style="width: 40px; height: 38px; color: purple; margin-top: 27px;"
                            onclick="deleteDiv(this)"><i class="fa fa-trash"></i></a> --}}
                    </div>
                @endforeach
            </div>

            {{-- </div> --}}
            <button type="submit" class="btn btn-primary" style="margin-left: 33px">Save</button>
        </div>
    </form>

    <script>
        const createInput = () => {
            const parent = document.getElementById("stoppage");
            const div = document.createElement("div");
            div.setAttribute('class', 'd-flex justify-content-between align-items-center');

            const div2 = document.createElement("div");
            div2.setAttribute('style', 'width: 48%;');

            const labelPlace = document.createElement("label");
            labelPlace.setAttribute("for", 'times');
            labelPlace.innerHTML = "pected Time";

            const labelTtime = document.createElement("label");
            labelTtime.setAttribute("for", 'stoppages');
            labelTtime.innerHTML = "Stoppages";

            const inputPlace = document.createElement("input");
            inputPlace.setAttribute("type", "text");
            inputPlace.setAttribute("class", "form-control");
            inputPlace.setAttribute("name", "stoppages[]");

            const inputTime = document.createElement("input");
            inputTime.setAttribute("type", "time");
            inputTime.setAttribute("class", "form-control");
            inputTime.setAttribute("name", "times[]");

            const aPlus = document.createElement("a");
            aPlus.setAttribute("class",
                "bg-warning d-flex align-items-center justify-content-center bordered rounded ml-1");
            aPlus.setAttribute("style", "width: 40px; color: purple");
            aPlus.setAttribute("onclick", "createInput()");

            const iPlus = document.createElement("i");
            iPlus.setAttribute("class", "fa fa-plus");

            const aDelete = document.createElement("a");
            aDelete.setAttribute("class",
                "bg-danger d-flex align-items-center justify-content-center bordered rounded ml-1");
            aDelete.setAttribute("style", "width: 40px; color: black");
            aDelete.setAttribute("onclick", "deleteDiv(this)");

            const iDelete = document.createElement("i");
            iDelete.setAttribute("class", "fa fa-trash");

            parent.appendChild(div);
            parent.appendChild(div2);

            aPlus.appendChild(iPlus);
            aDelete.appendChild(iDelete);
            div.appendChild(inputPlace);
            div.appendChild(inputTime);
            div.appendChild(aPlus);
            div.appendChild(aDelete);

        }

        let deleteDiv = (e) => {
            e.parentNode.remove();
            // console.log(e);
        }
    </script>
</x-backend.layouts.master>
