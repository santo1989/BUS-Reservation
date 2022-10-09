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
                                    {{-- @dd($booking) --}}
                                    <tr>
                                    <td>{{ ++$sl }}</td>
                                    <td> {{$booking->trip->start_date }}</td>
                                    <td> {{ $booking->event->name }}</td>
                                    <td> {{ $booking->trip->trip_code }}</td>
                
                                    <td> {{$booking->trip->stoppages }}</td>

                                    <td> {{ $booking->no_of_seat}}</td>
                                    <td>
                                        <a href="{{ route('editBooking', ['id'=> $booking->id]) }}" class="btn btn-success">Edit</a>

                                        {{-- <a href="{{ route('cancelBooking',['id'=> $booking->id]) }}" class="btn btn-danger">Cancel</a> --}}

                                            <form style="display:inline" action="{{ route('cancelBooking', ['id' => $booking->id]) }}" method="post">
                                                @csrf
                                                @method('delete')

                                                <button onclick="return confirm('Are you sure want to delete ?')" class="btn btn-sm btn-danger" type="submit">Cancel Booking</button>
                                            </form>
                                    </td>
                                    </tr>
                                    {{-- @empty
                                    <tr>
                                        <td colspan="7" class="text-center">You do not have any booking currently!</td> --}}

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