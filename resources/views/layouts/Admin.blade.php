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

                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Create Bus Information</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('buses.index') }}">Bus Entry</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Create New Events</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('events.index') }}">Events Entry</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>


            </div>



        </x-backend.layouts.master>