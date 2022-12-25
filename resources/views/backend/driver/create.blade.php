<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Add Form
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Driver </x-slot>

            <li class="breadcrumb-item"><a href="{{ route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Add New</li>

        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

<x-backend.layouts.elements.message :fmessage="session('message')" />
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Create Driver <a class="btn btn-sm btn-info" href="{{ route('drivers.index') }}">List</a>
        </div>
        <div class="card-body">
            

            <x-backend.layouts.elements.errors :errors="$errors"/>

            <form action="{{ route('drivers.store') }}" enctype="multipart/form-data" method="post">
                @csrf

                <x-backend.form.input name="name" type="text" label="Name"/>

                <x-backend.form.input name="license_no" type="text" label="License Number"/>

                <x-backend.form.input name="phone" type="text" label="Phone"/>

                <x-backend.form.input name="email" type="email" label="Email"/>

                <x-backend.form.input name="password" type="password" label="Password"/>

                <x-backend.form.input name="confirm_password" type="password" label="Confirm Password"/>

                {{-- <x-backend.form.input name="picture" type="file" label="Picture"/> --}}



                <x-backend.form.button>Save</x-backend.form.button>
            </form>
        </div>
    </div>


</x-backend.layouts.master>