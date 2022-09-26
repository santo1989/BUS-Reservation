<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Details
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Passenger </x-slot>

            <li class="breadcrumb-item"><a href="{{ route('passenger.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Add New</li>

        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
           Passenger Details <a class="btn btn-sm btn-info" href="{{ route('passenger.index') }}">List</a>
        </div>
        <div class="card-body">
                <p><h4>Passenger ID  : </h4>{{ $show_passenger->passenger_id }}</p>
                <p><h4>Year  : </h4>{{ $show_passenger->year }}</p>
                <p><h4>Driver Name  : </h4>{{ $show_passenger->driver_name }}</p>
                <p><h4>Passenger Session  : </h4>{{ $show_passenger->up_location }}</p>
        </div>
    </div>

</x-backend.layouts.master>