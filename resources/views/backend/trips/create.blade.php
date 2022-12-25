<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Create Trip
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Trip </x-slot>
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
    <form action="{{ route('trips.store') }}" method="post">
        <div>
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <x-backend.form.input name="start_date" type="date" label="Start Date" required />
                </div>
                <div class="col-md-6">
                    <x-backend.form.input name="end_date" type="date" label="End Date" required />
                </div>
                {{-- <div class="col-md-6">
                    <x-backend.form.input name="start_location" type="text" label="Start Location" required/>
                </div>
                <div class="col-md-6">
                    <x-backend.form.input name="end_location" type="text" label="End Location" required/>
                </div> --}}
            </div>

            <x-backend.form.textarea name="trip_details" label="Trip Details" required />

            <div class="row">
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
                    <label for="bus_id" class="mt-2">Bus</label>
                    <select name="bus_id" id="bus_id" class="form-select" required>
                        <option value="">Select One...</option>
                        @foreach ($buses as $bus)
                            <option value="{{ $bus->id }}">{{ $bus->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class=col-md-4>
                    <label for="driver_id" class="mt-2">Driver</label>
                    <select name="driver_id" id="driver_id" class="form-select" required>
                        <option value="">Select One...</option>
                        @foreach ($drivers as $driver)
                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group mt-3" id="stoppage">
                <div class="row">
                    <div class="col-md-6">
                        <label for="stoppages">Shuttle Start Location</label>
                        <input name="stoppages[]" class="form-control" id="stoppages" type="text" required>
                    </div>
                    <div class="col-md-6">
                        <label for="times">Expected Time</label>
                        <input name="times[]" class="form-control" id="times" type="time" required>
                    </div>
                    {{-- <div class="col-md-1">
                        <a class="bg-warning d-flex align-items-center justify-content-center bordered rounded w-100" style="width: 40px; height: 38px; color: purple; margin-top: 29px;" onclick="createInput()"><i class="fa fa-plus"></i></a>
                    </div> --}}
                </div>
            </div>
            <x-backend.form.button>Save</x-backend.form.button>
        </div>
    </form>
    <script>
        const createInput = () => {
            const parent = document.getElementById("stoppage");
            const div = document.createElement("div");
            div.setAttribute('class', 'row g-0 mt-2');

            const div2 = document.createElement("div");
            div2.setAttribute('class', 'col-md-6');

            const div3 = document.createElement("div");
            div3.setAttribute('class', 'col-md-5');

            const inputPlace = document.createElement("input");
            inputPlace.setAttribute("type", "text");
            inputPlace.setAttribute("class", "form-control");
            inputPlace.setAttribute("name", "stoppages[]");

            const inputTime = document.createElement("input");
            inputTime.setAttribute("type", "time");
            inputTime.setAttribute("class", "form-control");
            inputTime.setAttribute("name", "times[]");

            const aPlus = document.createElement("a");
            aPlus.setAttribute("class", "bg-warning d-flex align-items-center justify-content-center bordered rounded");
            aPlus.setAttribute("style", "width: 40px; color: purple");
            aPlus.setAttribute("onclick", "createInput()");

            const iPlus = document.createElement("i");
            iPlus.setAttribute("class", "fa fa-plus");

            const aDelete = document.createElement("a");
            aDelete.setAttribute("class",
            "bg-danger d-flex align-items-center justify-content-center bordered rounded");
            aDelete.setAttribute("style", "width: 40px; color: black");
            aDelete.setAttribute("onclick", "deleteDiv(this)");

            const btnDiv = document.createElement("div");
            btnDiv.setAttribute("class", "col-md-1 d-flex justify-content-between")

            const iDelete = document.createElement("i");
            iDelete.setAttribute("class", "fa fa-trash");

            div2.appendChild(inputPlace);
            div3.appendChild(inputTime);
            div.appendChild(div2);
            div.appendChild(div3);
            aPlus.appendChild(iPlus);
            aDelete.appendChild(iDelete);
            btnDiv.appendChild(aPlus)
            btnDiv.appendChild(aDelete)
            div.appendChild(btnDiv);
            parent.appendChild(div);
        }

        let deleteDiv = (e) => {
            e.parentNode.parentNode.remove();


            // console.log(e);
        }
    </script>



</x-backend.layouts.master>
