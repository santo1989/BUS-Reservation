<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Edit Form
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Passenger </x-slot>

            <li class="breadcrumb-item"><a href="{{ route('passenger.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit</li>

        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Edit Passenger <a class="btn btn-sm btn-info" href="{{ route('passenger.index') }}">List</a>
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

            <form action="{{ route('passenger.update', ['passenger' => $single_passenger->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <x-backend.form.input name="passenger_id" type="number" value="{{ $single_passenger->passenger_id }}"/>
                <br>
                <select name="year" class="form-control">
                    <option value="">Select Year</option>
                    <option value="2018" {{ $single_passenger->year == '2018' ? 'selected' : '' }}>2018</option>
                    <option value="2019" {{ $single_passenger->year == '2019' ? 'selected' : '' }}>2019</option>
                    <option value="2020" {{ $single_passenger->year == '2020' ? 'selected' : '' }}>2020</option>
                    <option value="2021" {{ $single_passenger->year == '2021' ? 'selected' : '' }}>2021</option>
                    <option value="2022" {{ $single_passenger->year == '2022' ? 'selected' : '' }}>2022</option>
                    <option value="2023" {{ $single_passenger->year == '2023' ? 'selected' : '' }}>2023</option>
                    <option value="2024" {{ $single_passenger->year == '2024' ? 'selected' : '' }}>2024</option>
                    <option value="2025" {{ $single_passenger->year == '2025' ? 'selected' : '' }}>2025</option>
                </select>
                <br>

                <x-backend.form.input name="up_location" type="number" value="{{ $single_passenger->up_location }}"/>
                <br>

                <select name="driver_name" class="form-control">
                    <option value="">Select Driver</option>
                    @foreach($drivers as $driver)
                        <option value="{{ $driver->driver_name }}" {{ $single_passenger->driver_id == $driver->driver_name ? 'selected' : '' }}>{{ $driver->driver_name }}</option>
                    @endforeach
                </select>

                <br>
                <x-backend.form.button>Update</x-backend.form.button>

            </form>
        </div>
    </div>


</x-backend.layouts.master>