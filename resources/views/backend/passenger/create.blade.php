<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Add Form
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
            Create Passenger <a class="btn btn-sm btn-info" href="{{ route('passengers.index') }}">List</a>
        </div>
        <div class="card-body">

           <x-backend.layouts.elements.errors :errors="$errors"/>

            <form action="{{ route('passengers.store') }}" enctype="multipart/form-data" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <x-backend.form.input name="name" type="text" label="Name"/>
                <br>
                <x-backend.form.input name="phone" type="phone" label="Phone No"/>
                <br>

                <x-backend.form.input name="address" type="address" label="Address"/>
                <br>
                <br>

                <x-backend.form.button>Save</x-backend.form.button>
            </form>
        </div>
    </div>


</x-backend.layouts.master>