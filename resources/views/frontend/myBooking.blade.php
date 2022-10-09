<x-frontend.layouts.master>

 
    <div class="container">
        @if(is_null($bookings) || empty($bookings))    
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <h1 class="text-danger"> <strong>You do not have any booking currently!</strong> </h1>
            </div>
        </div>
        @else
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">My Booking</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Sl#</th>
                                        <th>Trip Date </th>                         <th>Event Name</th>
                                        <th>Trip Name</th>
                                        <th>Stopage Name</th>
                                        <th>Booked Seat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $sl=0 @endphp
                                    @foreach ($bookings as $booking)
                                    {{-- @dd($booking->trip()) --}}
                                    <tr>
                                    <td>{{ ++$sl }}</td>
                                    <td> {{$booking->trip->start_date }}</td>
                                    <td> {{ $booking->event->name }}</td>
                                    <td> {{ $booking->trip->trip_code }}</td>
                
                                    <td> {{$booking->trip->stoppages }}</td>

                                    <td> {{ $booking->no_of_seat}}</td>
                                    
                                    </tr>


                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endif

    </x-frontend.layouts.master>