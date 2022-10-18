<x-frontend.layouts.master>
    <x-backend.layouts.elements.message :fmessage="session('message')" />

    <div class="container">
        @if (is_null($bookings) || empty($bookings))
            <div class="row text-center">
                <div class="col-md-12 col-lg-12 col-sm-12" style="height:100vh">
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
                                        <th>Trip Date </th>
                                        <th>Event Name</th>
                                        <th>Trip Name</th>
                                        <th>Shuttle Place and Time </th>
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
                                            <td> {{ $booking->trip->start_date }}</td>
                                            <td> {{ $booking->event->name }}</td>
                                            <td> {{ $booking->trip->trip_code }}</td>
                                            @php
                                                $stoppage = json_decode($booking->trip->stoppages, true);
                                            @endphp


                                            <td>
                                                @foreach ($stoppage as $key => $value)
                                                    {{ $key }}-{{ $value }} <br>
                                                @endforeach

                                            </td>

                                            <td> {{ $booking->no_of_seat }}</td>
                                            <td>
                                                @php
                                                    $date = date('Y-m-d');
                                                    $tripDate = $booking->trip->start_date;
                                                    
                                                    $date1 = strtotime($date);
                                                    $date2 = strtotime($tripDate);
                                                    $diff = abs($date2 - $date1);
                                                    $years = floor($diff / (365 * 60 * 60 * 24));
                                                    $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                                    $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                                                    
                                                @endphp
                                                @if ($days > 2)
                                                    <a href="{{ route('editBooking', ['id' => $booking->id]) }}"
                                                        class="btn btn-success">Edit</a>

                                                    <form style="display:inline"
                                                        action="{{ route('cancelBooking', ['id' => $booking->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')

                                                        <button
                                                            onclick="return confirm('Are you sure want to delete ?')"
                                                            class="btn btn-sm btn-danger" type="submit">Cancel
                                                            Booking</button>
                                                    </form>
                                                @else
                                                    <a href="#" class="btn btn-danger" disabled>Time Over</a>
                                                @endif





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
