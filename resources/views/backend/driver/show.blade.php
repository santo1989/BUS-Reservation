<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Details
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Driver </x-slot>

            <li class="breadcrumb-item"><a href="{{ route('drivers.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Add New</li>

        </x-backend.layouts.elements.breadcrumb>
    </x-slot>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Driver Details <a class="btn btn-sm btn-info" href="{{ route('drivers.index') }}">List</a>
        </div>
        <div class="container-fluid !direction !spacing">
            <div class="row">
                {{-- <div class="col-md-5">
                    <div class="card mb-4 mt-3">
                        <div class="card-body text-center">
                            <img src="{{ asset('images/drivers/' . $show_driver->picture) }}" alt=""
                                class="img" style="height: 250px; width:250px;">
                        </div>
                    </div>

                </div> --}}

                <div class="col-md-12">
                    <div class="card mb-4 mt-3">
                        <div class="card-body ">

                            <p><strong style="font-size: 1.5rem">Driver Name : </strong>{{ $show_driver->name }}</p>

                            <p><strong style="font-size: 1.5rem">Licence No : </strong>{{ $show_driver->license_no }}
                            </p>

                            <p><strong style="font-size: 1.5rem">Phone : </strong>{{ $show_driver->phone }}</p>

                            <p><strong style="font-size: 1.5rem">Email : </strong>{{ $show_driver->email }}</p>





                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>


</x-backend.layouts.master>
