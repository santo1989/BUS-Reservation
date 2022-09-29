<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Edit Form
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Passenger </x-slot>

            <li class="breadcrumb-item"><a href="{{ route('passengers.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit</li>

        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Edit Passenger <a class="btn btn-sm btn-info" href="{{ route('passengers.index') }}">List</a>
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

            <form action="{{ route('passengers.update', ['passenger' => $single_passenger->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <br>
                <x-backend.form.input name="name" type="text" label="Name" value="{{ $single_passenger->name }}"/>
                    <br>

                <x-backend.form.input name="phone" type="phone" label="Phone No" value="{{ $single_passenger->phone }}"/>

                    <br>

                <x-backend.form.input name="address" type="address" label="Address" value="{{ $single_passenger->address }}"/>



                <br>
                <x-backend.form.button>Update</x-backend.form.button>

            </form>
        </div>
    </div>


</x-backend.layouts.master>