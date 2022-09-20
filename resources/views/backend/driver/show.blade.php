<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Details
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Driver </x-slot>

            <li class="breadcrumb-item"><a href="{{ route('driver.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Add New</li>

        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
           Driver Details <a class="btn btn-sm btn-info" href="{{ route('driver.index') }}">List</a>
        </div>
        <div class="card-body">
                <p><h4>Driver Name  : </h4>{{ $show_driver->driver_name }}</p>
                
                <p><h4>Driver Code  : </h4>{{ $show_driver->contract_number }}</p>

        </div>
    </div>

</x-backend.layouts.master>