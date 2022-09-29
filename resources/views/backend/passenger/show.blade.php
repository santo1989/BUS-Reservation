<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Details
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Passenger </x-slot>

            <li class="breadcrumb-item"><a href="{{ route('passengers.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Add New</li>

        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
           Passenger Details <a class="btn btn-sm btn-info" href="{{ route('passengers.index') }}">List</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Name</th>
                    <td>{{ $show_passenger->name }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $show_passenger->phone }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{ $show_passenger->address }}</td>
                </tr>
            </table>
        </div>
    </div>

</x-backend.layouts.master>