<x-backend.layouts.master>
  <x-slot name="pageTitle">
     Bus List
 </x-slot>

 <x-slot name='breadCrumb'>
   <x-backend.layouts.elements.breadcrumb>
       <x-slot name="pageHeader"> Bus </x-slot>

       <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
       <li class="breadcrumb-item"><a href="{{ route('buses.index') }}">Bus</a></li>
   </x-backend.layouts.elements.breadcrumb>
</x-slot>

<section class="content">
  <div class="container-fluid">
 @if (is_null($buses) || empty($buses))
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <h1 class="text-danger"> <strong>Currently No Information Available!</strong> </h1>
                </div>
            </div>
        @else
@if (session('message'))
<div class="alert alert-success">
    <span class="close" data-dismiss="alert">&times;</span>
    <strong>{{ session('message') }}.</strong>
</div>
@endif

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <a class="btn btn-primary" href={{ route("buses.create") }}>Create</a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              {{-- bus Table goes here --}}

              <table id="datatablesSimple" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Sl#</th>
                    <th>Name</th>
                    <th>Reg Number</th>
                    <th>No of Seat</th>
                    <th>Actions</th>
                  
                </tr>
                </thead>
                <tbody>
                  @php $sl=0 @endphp
                  @foreach ($buses as $bus)
                    <tr>
                        <td>{{ ++$sl }}</td>
                        <td>{{ $bus->name }}</td>
                        <td>{{ $bus->reg_number }}</td>
                        <td>{{ $bus->no_of_seat }}</td>
                      <td>
                        <a class="btn btn-primary" href={{ route("buses.edit", ['single_buse'=>$bus->id]) }}>Edit</a>
                        <a class="btn btn-primary" href={{ route("buses.show", ['show_buse'=>$bus->id]) }}>Show</a>


                        @can('Admin')
                        <button class="btn btn-danger" onclick="deleteBus(<?php echo $bus->id; ?>)">Delete</button>
                            {{-- <form style="display:inline" action="{{ route('buses.destroy', ['buse' => $bus->id]) }}" method="post">
                                @csrf
                                @method('delete')

                                <button onclick="return confirm('Are you sure want to delete ?')" class="btn btn-danger" type="submit">Delete</button>
                            </form> --}}
                            @endcan
                      </td>
                    </tr>
                @endforeach
                
                </tbody>
              </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
 <input type="hidden" value="{{ url('') }}" id="base_url">

    {{--modal for bus delete--}}

    <div class="modal" tabindex="-1" id="myModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upcoming Trips This Bus Has</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()"></button>
            </div>
            <div class="modal-body" id="modal-body">
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#SL</th>
                            <th scope="col">Event</th>
                            <th scope="col">Trip Code</th>
                            <th scope="col">Bus</th>
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

        const deleteBus = (bus_id) => {
            getData(bus_id);
        }

        const getData = (bus_id) => {
            const base_url = $("#base_url").val();
            const fetch_url = `${base_url}/get-trips/by-bus/${bus_id}`;

            fetch(fetch_url)
            .then(response => response.json())
            .then(data => {
                const bus_to_delete = data[1];
                const trips = data[0];
                const buss = data[2];
                if(trips.length > 0) {
                    openModal(trips, buss, bus_id)
                } else {
                    if(confirm('Are you sure you want to delete')) {
                        window.location.href = `{{ URL::to('/bus/delete/${bus_id}') }}`;
                    }
                }
            })
        }

        const openModal = (trips, buss, bus_id) => {  
            myModal.show();

            const deleteForm = document.getElementById('deleteForm');
            const base_url = $("#base_url").val();
            const actionString = `${base_url}/buss/${bus_id}`;
            deleteForm.action = actionString;

            makeTable(trips, buss, bus_id);
        }

        const makeTable = (trips, buss, bus_id) => {
            const tbody = document.getElementById('tbody');
            tbody.innerHTML = '';
            let sl_index = 1;

            trips.map(trip => {
                const tr = document.createElement('tr');

                const sl = document.createElement('td');
                sl.textContent = sl_index++;

                const event = document.createElement('td');
                event.textContent = trip['event']['name'];

                const tripCode = document.createElement('td');
                tripCode.textContent = trip['trip_code'];

                const bus = document.createElement('td');

                const selectDiv = document.createElement('div');

                const selectBus  = document.createElement('select');
                selectBus.setAttribute('id', `trip-${trip['id']}`);
                selectBus.setAttribute('class', 'form-control');

                let options = `<option value="">Choose One...</option>`;
                buss.map(bus => {
                    options += `<option value="${bus['id']}">${bus['name']}</option>`;
                })
                selectBus.innerHTML = options;

                selectDiv.appendChild(selectBus);
                bus.appendChild(selectDiv)

                const action = document.createElement('td');
                const updateButton = document.createElement('button');
                updateButton.setAttribute('onclick', `updateBus(${trip['id']}, ${bus_id})`)
                updateButton.setAttribute('class', 'btn btn-warning')
                updateButton.textContent = "Update";
                action.appendChild(updateButton);

                tr.append(sl, event, tripCode, bus, action);

                tbody.appendChild(tr);                
            })
        }

        const updateBus = (trip_id, bus_id) => {
            const selectedBus = $(`#trip-${trip_id}`).val();

            if(selectedBus) {
                const base_url = $("#base_url").val();
                const fetch_url = `${base_url}/update-bus/${trip_id}/${selectedBus}`;

                fetch(fetch_url)
                .then(response => response.json())
                .then(data => {
                    if(data == true) {
                        myModal.hide();
                        getData(bus_id);
                    } else {
                        alert("Something went wrong");
                    }
                });
            } else {
                alert('Please select a bus');
            }
        }

        const closeModal = () => {
            myModal.hide();
        }
    </script>
@endif
</x-backend.layouts.master>