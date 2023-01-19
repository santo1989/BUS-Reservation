<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Trip List
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Trip </x-slot>

            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('trips.index') }}">Trip</a></li>
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    <section class="content">
        <div class="container-fluid">
@if (is_null($trips) || empty($trips))
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <h1 class="text-danger"> <strong>Currently No Information Available!</strong> </h1>
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
                            @can('Admin')
                                <a class="btn btn-primary" href={{ route('trips.create') }}>Create</a>
                            @endcan

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            {{-- bus Table goes here --}}

                            <table id="datatablesSimple" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Sl#</th>
                                        <th>Trip Code</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Shuttle Times</th>
                                        {{-- <th>Start Location</th> --}}
                                        {{-- <th>End Location</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sl=0 @endphp
                                    @foreach ($trips as $trip)
                                        @php $trip->stoppages = json_decode($trip->stoppages); @endphp
                                        <tr>
                                            <td>{{ ++$sl }}</td>
                                            <td>{{ $trip->trip_code }}</td>
                                            <td>{{ $trip->start_date }}</td>
                                            <td>{{ $trip->end_date }}</td>
                                            <td>
                                                @foreach ($trip->stoppages as $stoppage => $time)
                                                    {{-- <li>{{ $stoppage }} - {{ $time }}</li> --}}
                                                    @if(auth()->user()->time_format == 24)
                                                        <li>{{ $stoppage }} - {{ $time }}</li>
                                                    @else
                                                        <li>{{ $stoppage }} - {{ changeFormat($time) }}</li>
                                                    @endif
                                                    
                                                @endforeach
                                            </td>
                                            {{-- <td>{{ $trip->start_location }}</td> --}}
                                            {{-- <td>{{ $trip->end_location }}</td> --}}
                                            <td>
                                              @can('Admin')
                                                <a class="btn btn-primary"
                                                    href={{ route('trips.edit', ['trip_id' => $trip->id]) }}>Edit</a>
                                                <form action={{ route('trips.destroy', $trip->id) }} method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="submit">Delete</button>
                                                </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
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
    @endif
</x-backend.layouts.master>
