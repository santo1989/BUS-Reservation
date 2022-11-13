<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Edit Form
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Driver </x-slot>

            <li class="breadcrumb-item"><a href="{{ route('drivers.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit</li>

        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Edit Driver <a class="btn btn-sm btn-info" href="{{ route('drivers.index') }}">List</a>
        </div>
        <div class="card-body">

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('drivers.update', ['driver' => $single_driver->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <x-backend.form.input name="name" type="text" label="Name" :value="$single_driver->name "/>

                <x-backend.form.input name="license_no" type="text" label="License Number" :value="$single_driver->license_no" />

                <x-backend.form.input name="phone" type="text" label="Phone" :value="$single_driver->phone" />

                <x-backend.form.input name="email" type="email" label="Email" :value="$single_driver->email"/>

                <x-backend.form.input name="password" type="password" label="Password" :value="$single_driver->password"/>

                <x-backend.form.input name="confirm_password" type="password" label="Confirm Password" :value="$single_driver->confirm_password"/>

                {{-- <x-backend.form.input name="picture" type="file" label="Picture" :value="$single_driver->picture"/> --}}

                
                
                
                <x-backend.form.button>Update</x-backend.form.button>

            </form>
        </div>
    </div>


</x-backend.layouts.master>