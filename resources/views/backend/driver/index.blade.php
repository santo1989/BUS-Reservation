<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Driver
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Driver </x-slot>

            <li class="breadcrumb-item"><a href="{{ route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Driver</li>

        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    <div class="card mb-4" style="width:100%">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Driver

            {{-- @can('create-category') --}}
            <a class="btn btn-sm btn-info" href="{{ route('drivers.create') }}">Add New</a>
            {{-- @endcan --}}

        </div>
        <div class="card-body">

            <x-backend.layouts.elements.message :fmessage="session('message')" />
             <x-backend.layouts.elements.errors :errors="$errors"/>

            <!-- <table id="datatablesSimple"> -->
            <form method="GET" action="{{ route('drivers.index') }}">

            </form>
             @if (is_null($drivers) || empty($drivers))
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <h1 class="text-danger"> <strong>Currently No Information Available!</strong> </h1>
                </div>
            </div>
        @else
            <table class="table" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Sl#</th>
                        <th>Driver Name</th>
                        <th>Driver Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $sl=0 @endphp
                    @foreach ($drivers as $driver)
                    <tr>
                        <td>{{ ++$sl }}</td>
                       
                        <td>{{ $driver->name }}</td>
                        
                        <td>{{ $driver->phone }}</td>                      
                        
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('drivers.show', ['driver' => $driver->id]) }}">Show</a>

                            <a class="btn btn-warning btn-sm" href="{{ route('drivers.edit', ['driver' => $driver->id]) }}">Edit</a>

                            @can('Admin')
                                
                            <button class="btn btn-sm btn-danger" onclick="deleteDriver(<?php echo $driver->id; ?>)">Delete</button>

                            {{--<form style="display:inline" action="{{ route('drivers.destroy', ['driver' => $driver->id]) }}" method="post">
                                @csrf
                                @method('delete')

                                <button onclick="return confirm('Are you sure want to delete ?')" class="btn btn-sm btn-danger" type="submit">Delete</button>
                            </form>--}}
                            @endcan
                            {{-- <!-- <a href="{{ route('driver.destroy', ['driver' => $driver->id]) }}" >Delete</a> --> --}}


                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $drivers->links() }}
        </div>
    </div>

    <input type="hidden" value="{{ url('') }}" id="base_url">

    {{--modal for driver delete--}}

    <div class="modal" tabindex="-1" id="myModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upcoming Trips This Driver Has</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()"></button>
            </div>
            <div class="modal-body" id="modal-body">
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#SL</th>
                            <th scope="col">Event</th>
                            <th scope="col">Trip Code</th>
                            <th scope="col">Driver</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="closeModal()">Close</button>
                <form method="post" id="deleteForm">
                    @csrf
                    @method('delete')
                    <button onclick="return confirm('Are you sure want to delete ?')" class="btn btn-danger" type="submit">Delete With Trips</button>
                </form>
            </div>
            </div>
        </div>
    </div>

    {{--end modal--}}

    <script>

        const myModal = new bootstrap.Modal(document.getElementById('myModal'), {
            keyboard: true,
        });

        const deleteDriver = (driver_id) => {
            getData(driver_id);
        }

        const getData = (driver_id) => {
            const base_url = $("#base_url").val();
            const fetch_url = `${base_url}/get-trips/by-driver/${driver_id}`;

            fetch(fetch_url)
            .then(response => response.json())
            .then(data => {
                const driver_to_delete = data[1];
                const trips = data[0];
                const drivers = data[2];
                if(trips.length > 0) {
                    openModal(trips, drivers, driver_id)
                } else {
                    if(confirm('Are you sure you want to delete')) {
                        window.location.href = `{{ URL::to('/driver/delete/${driver_id}') }}`;
                    }
                }
            })
        }

        const openModal = (trips, drivers, driver_id) => {  
            myModal.show();

            const deleteForm = document.getElementById('deleteForm');
            const base_url = $("#base_url").val();
            const actionString = `${base_url}/drivers/${driver_id}`;
            deleteForm.action = actionString;

            makeTable(trips, drivers, driver_id);
        }

        const makeTable = (trips, drivers, driver_id) => {
            const tbody = document.getElementById('tbody');
            tbody.innerHTML = '';
            let sl_index = 1;

            trips.map(trip => {
                const tr = document.createElement('tr');

                const sl = document.createElement('td');
                sl.textContent = sl_index;

                const event = document.createElement('td');
                event.textContent = trip['event']['name'];

                const tripCode = document.createElement('td');
                tripCode.textContent = trip['trip_code'];

                const driver = document.createElement('td');

                const selectDiv = document.createElement('div');

                const selectDriver  = document.createElement('select');
                selectDriver.setAttribute('id', `trip-${trip['id']}`);
                selectDriver.setAttribute('class', 'form-control');

                let options = `<option value="">Choose One...</option>`;
                drivers.map(driver => {
                    options += `<option value="${driver['id']}">${driver['name']} - ${driver['license_no']}</option>`;
                })
                selectDriver.innerHTML = options;

                selectDiv.appendChild(selectDriver);
                driver.appendChild(selectDiv)

                const action = document.createElement('td');
                const updateButton = document.createElement('button');
                updateButton.setAttribute('onclick', `updateDriver(${trip['id']}, ${driver_id})`)
                updateButton.setAttribute('class', 'btn btn-sm btn-warning')
                updateButton.textContent = "Update";
                action.appendChild(updateButton);

                tr.append(sl, event, tripCode, driver, action);

                tbody.appendChild(tr);                
            })
        }

        const updateDriver = (trip_id, driver_id) => {
            const selectedDriver = $(`#trip-${trip_id}`).val();

            if(selectedDriver) {
                const base_url = $("#base_url").val();
                const fetch_url = `${base_url}/update-driver/${trip_id}/${selectedDriver}`;

                fetch(fetch_url)
                .then(response => response.json())
                .then(data => {
                    if(data == true) {
                        myModal.hide();
                        getData(driver_id);
                    } else {
                        alert("Something went wrong");
                    }
                });
            } else {
                alert('Please select a driver');
            }
        }

        const closeModal = () => {
            myModal.hide();
        }        
    </script>
@endif
</x-backend.layouts.master>