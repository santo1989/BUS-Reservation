<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Events
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Events </x-slot>

            <li class="breadcrumb-item"><a href="{{ route('events.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Events</li>

        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Events <a class="btn btn-sm btn-info" href="{{ route('events.index') }}">List</a>
        </div>
        <div class="card-body">

            @if (session('message'))
            <div class="alert alert-success">
                <span class="close" data-dismiss="alert">&times;</span>
                <strong>{{ session('message') }}.</strong>
            </div>
            @endif

            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Sl#</th>
                        <th>Name</th>
                        <th>Details</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $sl=0 @endphp
                    @foreach ($events as $events)
                    <tr>
                        <td>{{ ++$sl }}</td>
                        <td>{{ $events->name }}</td>
                        <td>{{ $events->details }}</td>

                        <td>
                        
                            <a class="btn btn-warning btn-sm" href="{{ route('events.restore', ['events' => $events->id]) }}" >Restore</a>

                            <form style="display:inline" action="{{ route('events.delete', ['events' => $events->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                
                                <button onclick="return confirm('Are you sure want to delete permanently?')" class="btn btn-sm btn-danger" type="submit">Permanent Delete</button>
                            </form>

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

</x-backend.layouts.master>