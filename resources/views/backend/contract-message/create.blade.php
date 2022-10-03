<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Add Form
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Message Input </x-slot>

            <li class="breadcrumb-item"><a href="{{ route('contract_message.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Add New</li>

        </x-backend.layouts.elements.breadcrumb>
    </x-slot>


    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Create Message Input <a class="btn btn-sm btn-info" href="{{ route('contract_message.index') }}">List</a>
        </div>
        <div class="card-body">

           <x-backend.layouts.elements.errors :errors="$errors"/>

            <form action="{{ route('contract_message.store') }}" enctype="multipart/form-data" method="post">
                @csrf

            </form>
            
        </div>
    </div>


</x-backend.layouts.master>