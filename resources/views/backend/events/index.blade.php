<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Events
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Events </x-slot>

            <li class="breadcrumb-item"><a href="{{ route('events.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Events</li>

        </x-backend.layouts.elements.breadcrumb>
    </x-slot>
@if (is_null($events) || empty($events))
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <h1 class="text-danger"> <strong>Currently No Information Available!</strong> </h1>
                </div>
            </div>
        @else
    <div class="card" style="width:100%" >
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Events  
             @can('Admin')
            <a class="btn btn-sm btn-danger" href="{{ route('events.trashed') }}">Trashed List</a>

         
            <a class="btn btn-sm btn-info" href="{{ route('events.create') }}">Add New</a>
            @endcan

        </div>
        <div class="card-body " >

            <x-backend.layouts.elements.message :fmessage="session('message')" />
            
            <table class="table " id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Sl#</th>
                        <th>Title</th>
                        <th>Details</th>                        
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $sl=0 @endphp
                    @foreach ($events as $event)
                    <tr>
                        <td>{{ ++$sl }}</td>

                        <td>{{ $event->name }}</td>

                        <td> {{ Str::limit($event->details, 50) }} </td>
                        
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('events.show', ['event_show' => $event->id]) }}">Show</a>

                            @can('Admin')
                                
                           

                            <a class="btn btn-warning btn-sm" href="{{ route('events.edit', ['single_event' => $event->id]) }}">Edit</a>

                            <button class="btn btn-sm btn-danger" onclick="deleteEvent(<?php echo $event->id; ?>)">Delete</button>
                            {{-- @dd($event->id) --}}

                             {{-- <form style="display:inline" action="{{ route('events.destroy', ['event_id' => $event->id]) }}" method="post">
                                @csrf
                                @method('delete')

                                <button onclick="return confirm('Are you sure want to delete ?')" class="btn btn-sm btn-danger" type="submit">Delete</button>
                            </form> --}}
 @endcan
                            {{-- <!-- <a href="{{ route('events.destroy', ['events' => $events->id]) }}" >Delete</a> --> --}}


                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{-- {{ $events->links() }} --}}
        </div>
    </div>

    {{--modal for --}}
    
 <input type="hidden" value="{{ url('') }}" id="base_url">

    {{--modal for event delete--}}

    <div class="modal" tabindex="-1" id="myModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upcoming Trips This Event Has</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()"></button>
            </div>
            <div class="modal-body" id="modal-body">
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#SL</th>
                            <th scope="col">Trip Code</th>
                            <th scope="col">Event</th>
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
                    <button onclick="return confirm('Are you sure want to delete ?')" class="btn btn-sm btn-danger" type="submit">Delete With Trips</button>
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

        const deleteEvent = (event_id) => {
            getData(event_id);
        }

        const getData = (event_id) => {
            const base_url = $("#base_url").val();
            const fetch_url = `${base_url}/get-trips/by-event/${event_id}`;
            console.log(fetch_url);

            fetch(fetch_url)
            .then(response => response.json())
            .then(data => {
                const event_to_delete = data[1];
                const trips = data[0];
                const events = data[2];
                if(trips.length > 0) {
                    openModal(trips, events, event_id)
                } else {
                    if(confirm('Are you sure you want to delete')) {
                        window.location.href = `{{ URL::to('/event/delete/${event_id}') }}`;
                    }
                }
            })
        }

        const openModal = (trips, events, event_id) => {  
            myModal.show();

            const deleteForm = document.getElementById('deleteForm');
            const base_url = $("#base_url").val();
            const actionString = `${base_url}/events/${event_id}`;
            deleteForm.action = actionString;
            // console.log(actionString);

            makeTable(trips, events, event_id);
        }

        const makeTable = (trips, events, event_id) => {
            const tbody = document.getElementById('tbody');
            tbody.innerHTML = '';
            let sl_index = 1;

            trips.map(trip => {
                const tr = document.createElement('tr');

                const sl = document.createElement('td');
                sl.textContent = sl_index;

                const tripCode = document.createElement('td');
                tripCode.textContent = trip['trip_code'];

                const event = document.createElement('td');

                const selectDiv = document.createElement('div');

                const selectEvent  = document.createElement('select');
                selectEvent.setAttribute('id', `trip-${trip['id']}`);
                selectEvent.setAttribute('class', 'form-control');

                let options = `<option value="">Choose One...</option>`;
                events.map(event => {
                    options += `<option value="${event['id']}">${event['name']}</option>`;
                })
                selectEvent.innerHTML = options;

                selectDiv.appendChild(selectEvent);
                event.appendChild(selectDiv)

                const action = document.createElement('td');
                const updateButton = document.createElement('button');
                updateButton.setAttribute('onclick', `updateEvent(${trip['id']}, ${event_id})`)
                updateButton.setAttribute('class', 'btn btn-sm btn-warning')
                updateButton.textContent = "Update";
                action.appendChild(updateButton);

                tr.append(sl, event, tripCode, event, action);

                tbody.appendChild(tr);                
            })
        }

        const updateEvent = (trip_id, event_id) => {
            const selectedEvent = $(`#trip-${trip_id}`).val();

            if(selectedEvent) {
                const base_url = $("#base_url").val();
                const fetch_url = `${base_url}/update-event/${trip_id}/${selectedEvent}`;

                fetch(fetch_url)
                .then(response => response.json())
                .then(data => {
                    if(data == true) {
                        myModal.hide();
                        getData(event_id);
                    } else {
                        alert("Something went wrong");
                    }
                });
            } else {
                alert('Please select a event');
            }
        }

        const closeModal = () => {
            myModal.hide();
        }
    </script>





   


@endif

</x-backend.layouts.master>