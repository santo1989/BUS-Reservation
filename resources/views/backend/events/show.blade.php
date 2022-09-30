<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Details
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Events </x-slot>

            <li class="breadcrumb-item"><a href="{{ route('events.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Add New</li>

        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
           Events Details <a class="btn btn-sm btn-info" href="{{ route('events.index') }}">List</a>
        </div>
        <div class="card-body">
           
                <p>Image : <h3>
                   @foreach ($event_show->images as $image)
                     <img src="{{ asset('images/events/'.$image) }}" alt="" width="100px" height="100px">
                   @endforeach
                </h3></p>
                <p>Name : <h3>{{ $event_show->name }}</h3></p>
                <p>Details :  <h3>{{ $event_show->details }}</h3></p>   

        </div>
    </div>

</x-backend.layouts.master>