<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Passenger List
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Passenger List </x-slot>

            <li class="breadcrumb-item"><a href="{{ route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Passenger List</li>

        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    <div class="card mb-4" style="width:100%">
       
        <div class="card-body">

            <x-backend.layouts.elements.message :fmessage="session('message')" />
            <table class="table">
                <thead>
                    <tr>
                        <th>Sl#</th>
                        <th>Trip Code</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $sl=0 @endphp
                    @foreach ($trips as $trip)
                    <tr>
                        <td>{{ ++$sl }}</td>
                        <td>{{ $trip->trip_code }}</td>
                        <td>{{ $trip->start_date }}</td>                      
                        <td>{{ $trip->end_date }}</td>                      
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('driver.trip.passengerList', ['trip_id'=>$trip->id]) }}">Passenger List</a>

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

</x-backend.layouts.master>