<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Driver
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Driver </x-slot>

            <li class="breadcrumb-item"><a href="{{ route('driver.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Driver</li>

        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    <div class="card mb-4" style="width:100%">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Driver

            {{-- @can('create-category') --}}
            <a class="btn btn-sm btn-info" href="{{ route('driver.create') }}">Add New</a>
            {{-- @endcan --}}

        </div>
        <div class="card-body">

            <x-backend.layouts.elements.message :fmessage="session('message')" />

            <!-- <table id="datatablesSimple"> -->
            <form method="GET" action="{{ route('driver.index') }}">
                <x-backend.form.input style="width: 200px;" name='search' />

            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th>Sl#</th>
                        <th>Driver Name</th>
                        <th>Driver Code</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $sl=0 @endphp
                    @foreach ($drivers as $driver)
                    <tr>
                        <td>{{ ++$sl }}</td>
                       
                        <td>{{ $driver->driver_name }}</td>
                        
                        <td>{{ $driver->contract_number }}</td>                      
                        
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('driver.show', ['driver' => $driver->id]) }}">Show</a>

                            <a class="btn btn-warning btn-sm" href="{{ route('driver.edit', ['driver' => $driver->id]) }}">Edit</a>

                            <form style="display:inline" action="{{ route('driver.destroy', ['driver' => $driver->id]) }}" method="post">
                                @csrf
                                @method('delete')

                                <button onclick="return confirm('Are you sure want to delete ?')" class="btn btn-sm btn-danger" type="submit">Delete</button>
                            </form>

                            {{-- <!-- <a href="{{ route('driver.destroy', ['driver' => $driver->id]) }}" >Delete</a> --> --}}


                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $drivers->links() }}
        </div>
    </div>

</x-backend.layouts.master>