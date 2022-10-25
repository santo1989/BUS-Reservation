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
            <table class="table" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Check Box</th>
                        <th>Sl#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Shuttle Place and Time</th>
                        <th>Booked Seat</th>
                    </tr>
                </thead>
                <tbody>
                    @php $sl=0 @endphp
                    @foreach ($bookings as $booking)
                    {{-- @dd($booking) --}}
                    <tr>
                        <td>
                            <input type="checkbox">
                        </td>
                        <td>{{ ++$sl }}</td>
                        <td>{{ $booking->passenger->name }}</td>
                        <td>{{ $booking->passenger->phone }}</td>                      
                        <td>{{ $booking->stoppage }}</td>
                        <td>{{ $booking->no_of_seat }}</td>                      
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
  
       
        

</x-backend.layouts.master>