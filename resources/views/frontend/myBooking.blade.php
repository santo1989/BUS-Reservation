<x-frontend.layouts.master>

<div id="screenSize">
    @if (is_null($bookings) || empty($bookings))
        <div class="row text-center">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <h1 class="text-danger text-center"> <strong>You do not have any booking currently!</strong> </h1>
            </div>
        </div>
    @else
        <x-backend.layouts.elements.message :fmessage="session('message')" />
        {{-- <div class="card mb-4" style="width:100%"> --}}
        <h3 class="text-center">My Booking</h3>
        {{-- <div class="card-body"> --}}

        <div class="table-responsive">
            <table class="table table-bordered table-responsive">
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
                    {{-- @dd($bookings) --}}
                    @forelse ($bookings as $booking)
                       
                        <tr>
                            <td>{{ ++$sl }}</td>
                            @php
                                $tripDate = \Carbon\Carbon::parse($booking->trip->start_date)->format('d-m-Y');
                            @endphp

                             {{-- @dd($booking->trip->start_date) --}}
                            <td> {{ $tripDate }}</td>
                            <td> {{ $booking->event->name }}</td>
                            <td> {{ $booking->trip->trip_code }}</td>
                            {{-- @php
                                    // $stoppage = json_decode($booking->trip->stoppages, true);
                                    $stoppage = json_decode($booking->stoppage, true);
                                @endphp --}}


                            <td>
                                {{ $booking->stoppage }}


                            </td>

                            <td> {{ $booking->no_of_seat }}</td>
                            <td>
                                @php
                                    $date = date('d-m-Y');
                                    // $tripDate = $booking->trip->start_date;
                                    
                                    $date1 = strtotime($date);
                                    $date2 = strtotime($tripDate);
                                    $diff = abs($date2 - $date1);
                                    $years = floor($diff / (365 * 60 * 60 * 24));
                                    $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                    $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                                    
                                @endphp
                                @if ($days > 0.5)
                                    <a href="{{ route('editBooking', ['id' => $booking->id]) }}"
                                        class="btn btn-success">Edit</a>
                                @else
                                @endif
                                @if ($days > 1)
                                    <form style="display:inline"
                                        action="{{ route('cancelBooking', ['id' => $booking->id]) }}" method="post">
                                        @csrf
                                        @method('delete')

                                        <button onclick="return confirm('Are you sure want to delete ?')"
                                            class="btn btn-sm btn-danger" type="submit">Cancel
                                            Booking</button>
                                    </form>
                                @else
                                    <a href="#" class="btn btn-danger" disabled>Time Over</a>
                                @endif





                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No Data Found</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
            {{-- </div> --}}
            {{-- </div> --}}

        </div>

    @endif
</div>

 <script>
    let booking_size = <?php echo isset($bookings) == 1 ? count($bookings) : ''; ?>; 
    let screenSize = document.getElementById('screenSize');
    if(booking_size<=3)
     screenSize.style.height = '50vh';
</script>
</x-frontend.layouts.master>
