@switch(auth()->user()->role->name)
    @case('Admin')
        <x-backend.layouts.master>

            <x-slot name="pageTitle">
                Admin Dashboard
            </x-slot>

            <x-slot name='breadCrumb'>
                <x-backend.layouts.elements.breadcrumb>
                    <x-slot name="pageHeader"> Dashboard </x-slot>
                    <li class="breadcrumb-item active">Dashboard</li>
                </x-backend.layouts.elements.breadcrumb>
            </x-slot>


            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Driver Assign to Bus</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('drivers.index') }}">Driver Entry</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>



        </x-backend.layouts.master>
    @break

    @case('Driver')
        <x-backend.layouts.master>
            <div class="m-5">
                <h3>Welcome,
                    @php
                        echo auth()->user()->name;
                    @endphp !
                </h3>
            </div>

            @php
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
            @endphp

            <section class="content">
                <div class="container-fluid">

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
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div id="accordion">
                                        
                                            {{-- @dd($booking); --}}
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h4 class="card-title w-100">
                                                        <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                                            {{ $today_trip->trip_code }}
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Passenger Name</th>
                                                                    <th>Passenger Phone</th>
                                                                    <th>Passenger Email</th>
                                                                    <th>Passenger Address</th>
                                                                    <th>Passenger Seat</th>
                                                                    <th><i class="fa fa-space-shuttle" aria-hidden="true"></i>
                                                                        Shuttle Place and Time</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                              @forelse ($today_trip->bookings as $booking)
                                                                @php
                                                                    $passengers = App\Models\Passenger::where('id', $booking->passenger_id)->first();
                                                                    // @dd($passenger);
                                                                @endphp
                                                                <tr>
                                                                    <td>{{ $passengers->name }}</td>
                                                                    <td>{{ $passengers->phone }}</td>
                                                                    <td>{{ $passengers->user->email }}</td>
                                                                    <td>{{ $passengers->address }}</td>
                                                                    <td>{{ $booking->no_of_seat }}</td>
                                                                    <td>{{ $booking->stoppage }}</td>
                                                                </tr>
                                                                @empty
                                                                <div class="alert alert-danger">
                                                                  <span class="close" data-dismiss="alert">&times;</span>
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





        </x-backend.layouts.master>
    @break

    @case('Guest')
        <x-backend.layouts.master>
            <x-slot name="pageTitle">
                Guest Portal
            </x-slot>

            <x-slot name='breadCrumb'>
                <x-backend.layouts.elements.breadcrumb>
                    <x-slot name="pageHeader"> Welcome, {{ auth()->user()->name }} </x-slot>

                </x-backend.layouts.elements.breadcrumb>
            </x-slot>
            <div class="col-md-12"><i class="fas fa-tachometer-alt"></i>
                Waiting for Cooridinator Conformation
            </div>

            {{-- </div> --}}
        </x-backend.layouts.master>
    @break

    @default
        <x-backend.layouts.master>


        </x-backend.layouts.master>
@endswitch

<script>
    // $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })

    $('#reservation').daterangepicker()

    //   Date picker JS
</script>
{{-- @endif --}}
