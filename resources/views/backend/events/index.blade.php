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

    <div class="card" style="width:100%" >
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Events  
             @can('admin')
            <a class="btn btn-sm btn-danger" href="{{ route('events.trashed') }}">Trashed List</a>

         
            <a class="btn btn-sm btn-info" href="{{ route('events.create') }}">Add New</a>
            @endcan

        </div>
        <div class="card-body " >

            <x-backend.layouts.elements.message :fmessage="session('message')" />
            
            <table class="table ">
                <thead>
                    <tr>
                        <th>Sl#</th>
                        <th>Title</th>
                        <th>Details</th>                        
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $sl=0 @endphp
                    @foreach ($events as $event)
                    <tr>
                        <td>{{ ++$sl }}</td>

                        <td>{{ $event->name }}</td>

                        <td>{{ $event->details }}</td>
                        
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('events.show', ['event_show' => $event->id]) }}">Show</a>

                            @can('admin')
                                
                           

                            <a class="btn btn-warning btn-sm" href="{{ route('events.edit', ['single_event' => $event->id]) }}">Edit</a>

                             <form style="display:inline" action="{{ route('events.destroy', ['event_id' => $event->id]) }}" method="post">
                                @csrf
                                @method('delete')

                                <button onclick="return confirm('Are you sure want to delete ?')" class="btn btn-sm btn-danger" type="submit">Delete</button>
                            </form>
 @endcan
                            {{-- <!-- <a href="{{ route('events.destroy', ['events' => $events->id]) }}" >Delete</a> --> --}}


                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{-- {{ $events->links() }} --}}
        </div>
    </div>

</x-backend.layouts.master>