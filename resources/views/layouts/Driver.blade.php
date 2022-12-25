<x-backend.layouts.master>
    <div class="m-5">
        <h3>Welcome,
            @php
                echo auth()->user()->name;
            @endphp !
        </h3>
    </div>

    {{-- @php
        $driver = App\Models\Driver::where('user_id', auth()->user()->id)->first();
        $trip_table = App\Models\Trip::where('driver_id', $driver->id)->get();
        // dd($trip_table);
        $today = date('Y-m-d');
        $today_trip = App\Models\Trip::where('driver_id', $driver->id)
            ->where('start_date', $today)
            ->first();
        // dd($today_trip);
        // $passenger_id = App\Models\Booking::where('trip_id', $trip_table->id)->get();
        // dd($passenger_id);
        //   $passanger = App\Models\Passenger::where('id', $passenger_id->passenger_id)->get();
        //   dd($passanger);
    @endphp --}}


    {{-- <section class="content">
        <div class="container-fluid">
            @if (is_null($today_trip) || empty($today_trip))
                <div class="row text-center">
                    <div class="col-md-12 col-lg-12 col-sm-12" style="height:100vh">
                        <h1 class="text-danger"> <strong>You do not have any trip Today!</strong> </h1>
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
                                <h3 class="card-title text-center">Today Trip Table</h3>
                            </div> --}}
                            <!-- /.card-header -->
                            {{-- <div class="card-body">
                                <div id="accordion"> --}}

                                    {{-- @dd($booking); --}}
                                    {{-- <div class="card card-primary">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                                    {{ $today_trip->trip_code ?? '' }}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Check Box</th>
                                                                <th>Passenger Name</th>
                                                                <th>Passenger Phone</th>
                                                                <th>Passenger Email</th>
                                                                <th>Passenger Address</th>
                                                                <th>Passenger Seat</th>
                                                                <th><i class="fa fa-space-shuttle"
                                                                        aria-hidden="true"></i>
                                                                    Shuttle Place and Time</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($today_trip->bookings as $booking)
                                                                @php 
                                                                    $passengers = App\Models\Passenger::where('id', $booking->passenger_id)->first();
                                                                    // @dd($passenger);
                                                                @endphp--}}
                                                                {{-- <tr>
                                                                    <td>
                                                                        <input type="checkbox">
                                                                    </td>
                                                                    <td>{{ $passengers->name }}</td>
                                                                    <td>{{ $passengers->phone }}</td>
                                                                    <td>{{ $passengers->user->email }}</td>
                                                                    <td>{{ $passengers->address }}</td>
                                                                    <td>{{ $booking->no_of_seat }}</td>
                                                                    <td>{{ $booking->stoppage }}</td>
                                                                </tr>
                                                            @empty
                                                                <div class="alert alert-danger">
                                                                    <span class="close"
                                                                        data-dismiss="alert">&times;</span>
                                                                    <strong>No Trip Found.</strong>
                                                                </div>
                                                            @endforelse
                                                        </tbody>

                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div> --}}
                            <!-- /.card-body -->
                        {{-- </div> --}}
                        <!-- /.card -->


                        <!-- /.card -->
                    {{-- </div> --}}
                    <!-- /.col -->
                {{-- </div> --}}
                <!-- /.row -->
        {{-- </div> --}}
        <!-- /.container-fluid -->
    {{-- </section>
    @endif --}}
     @php
                    $driverId = auth()->user()->driver->id;
        $currentDate = date('Y-m-d');
        $trips = App\Models\Trip::where('driver_id', $driverId)
            ->where('start_date', '>=', $currentDate)->orderBy('start_date')->get();

                    @endphp
                    @if (is_null($trips) || empty($trips))
                <div class="row text-center">
                    <div class="col-md-12 col-lg-12 col-sm-12" style="height:100vh">
                        <h1 class="text-danger"> <strong>You do not have any trip Today!</strong> </h1>
                    </div>
                </div>
            @else
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
@endif
</x-backend.layouts.master>
