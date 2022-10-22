<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Message 
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Message  </x-slot>

            <li class="breadcrumb-item"><a href="{{ route('contract_message.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Message </li>

        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Message 

            {{-- @can('create-category') --}}
            {{-- <a class="btn btn-sm btn-info" href="{{ route('contract_message.create') }}">Add New</a> --}}
            {{-- @endcan --}}

        </div>
        <div class="card-body">

            <x-backend.layouts.elements.message :fmessage="session('message')" />

            <!-- <table id="datatablesSimple"> -->
            {{-- <form method="GET" action="{{ route('contract_message.index') }}">
                <x-backend.form.input style="width: 200px;" name='search' />

            </form> --}}
             @if (is_null($contract_messages) || empty($contract_messages))
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <h1 class="text-danger"> <strong>Currently No Information Available!</strong> </h1>
                </div>
            </div>
        @else
            <table class="table" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Sl#</th>
                        <th>Messanger Name</th>
                        <th>E-mail</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $sl=0 @endphp
                    @foreach ($contract_messages as $contract_message)
                    <tr>
                        <td>{{ ++$sl }}</td>
                       
                        <td>{{ $contract_message->name }}</td> 
                        <td>{{ $contract_message->email }}</td>
                        
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('contract_message.show', ['message' => $contract_message->id]) }}">Show</a>

                            {{-- <a class="btn btn-warning btn-sm" href="{{ route('contract_message.edit', ['contract_message' => $contract_message->id]) }}">Edit</a> --}}

                            <form style="display:inline" action="{{ route('contract_message.destroy', ['message' => $contract_message->id]) }}" method="post">
                                @csrf
                                @method('delete')

                                <button onclick="return confirm('Are you sure want to delete ?')" class="btn btn-sm btn-danger" type="submit">Delete</button>
                            </form>

                            {{-- <!-- <a href="{{ route('contract_message.destroy', ['contract_message' => $contract_message->id]) }}" >Delete</a> --> --}}


                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{-- {{ $contract_messages->links() }} --}}
        </div>
    </div>
@endif
</x-backend.layouts.master>