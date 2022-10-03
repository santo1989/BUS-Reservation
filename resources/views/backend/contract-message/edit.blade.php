<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Edit Form
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Message Input </x-slot>

            <li class="breadcrumb-item"><a href="{{ route('contract_message.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit</li>

        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Edit Message Input <a class="btn btn-sm btn-info" href="{{ route('contract_message.index') }}">List</a>
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

            <form action="{{ route('contract_message.update', ['contract_message' => $single_contract_message->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                

            </form>
        </div>
    </div>


</x-backend.layouts.master>