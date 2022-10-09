<x-frontend.layouts.master>

        <div class="container">
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
                                        <th>Trip Date <th>                         <th>Event Name</th>
                                        <th>Trip Name</th>
                                        <th>Stopage Name</th>
                                        <th>Booked Seat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $sl=0 @endphp
                                    @foreach ($bookinfo as $booking)
                                    {{-- <tr> --}}
                                    <td>{{ ++$sl }}</td>
                                    <td> {{ $booking->start_date }}</td>
                                    <td> {{ $booking->name }}</td>
                                    <td> {{ $booking->trip_code }}</td>
                                    <td> {{ $booking->stoppages }} {{ $booking->start_location }}</td>

                                    <td> {{ $booking->no_of_seat}}</td>
                                    {{-- </tr> --}}


                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


</x-frontend.layouts.master>