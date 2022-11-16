<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Passenger
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Passenger </x-slot>

            <li class="breadcrumb-item"><a href="{{ route('passengers.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Passenger</li>

        </x-backend.layouts.elements.breadcrumb>
    </x-slot>
@if (is_null($passengers) || empty($passengers))
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <h1 class="text-danger"> <strong>Currently No Information Available!</strong> </h1>
                </div>
            </div>
        @else
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Passenger
        @can('create-passenger')
        @php
            $model0fpassenger = App\Models\Passenger::find($user_id = auth()->user()->id);
            // dd($model0fpassenger);
        @endphp
        @if ($model0fpassenger == null)
            <a class="btn btn-sm btn-info" href="{{ route('passengers.create') }}">Add New</a>
            
        @endif
            {{-- <a class="btn btn-sm btn-info" href="{{ route('passenger.create') }}">Add New</a> --}}
        @endcan
            
        </div>
        <div class="card-body">

            <x-backend.layouts.elements.message :fmessage="session('message')" />

            <!-- <table id="datatablesSimple"> -->
            {{-- <form method="GET" action="{{ route('passengers.index') }}">
                <x-backend.form.input style="width: 200px;" name='search' />

            </form> --}}
            <table class="table" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Sl#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $sl=0 @endphp
                    @foreach ($passengers as $passenger)
                    <tr>
                        <td>{{ ++$sl }}</td>
                       
                        <td>{{ $passenger->name }}</td>
                        <td>{{ $passenger->phone }}</td>
                        <td>{{ $passenger->address }}</td>
                        
                        
                        <td>
                            @can('create-passenger')
                            <a class="btn btn-info btn-sm" href="{{ route('passengers.show', ['passenger' => $passenger->id]) }}">Show</a>
                           {{-- @can('Admin') --}}
                            <a class="btn btn-warning btn-sm" href="{{ route('passengers.edit', ['passenger' => $passenger->id]) }}">Edit</a>
                            @endcan
                            
                            <form style="display:inline" action="{{ route('passengers.destroy', ['passenger' => $passenger->id]) }}" method="post">
                                @csrf
                                @method('delete')

                                <button onclick="return confirm('Are you sure want to delete ?')" class="btn btn-sm btn-danger" type="submit">Delete</button>
                            </form>
                            {{-- @endcan --}}
                            {{-- <!-- <a href="{{ route('passenger.destroy', ['passenger' => $passenger->id]) }}" >Delete</a> --> --}}


                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{-- {{ $passengers->links() }} --}}
        </div>
    </div>
@endif
</x-backend.layouts.master>