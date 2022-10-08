<x-backend.layouts.master>
  <x-slot name="pageTitle">
     Bus List
 </x-slot>

 <x-slot name='breadCrumb'>
   <x-backend.layouts.elements.breadcrumb>
       <x-slot name="pageHeader"> Bus </x-slot>

       <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
       <li class="breadcrumb-item"><a href="{{ route('buses.index') }}">Bus</a></li>
   </x-backend.layouts.elements.breadcrumb>
</x-slot>

<section class="content">
  <div class="container-fluid">

@if (session('message'))
<div class="alert alert-success">
    <span class="close" data-dismiss="alert">&times;</span>
    <strong>{{ session('message') }}.</strong>
</div>
@endif

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <a class="btn btn-primary" href={{ route("buses.create") }}>Create</a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              {{-- bus Table goes here --}}

              <table id="datatablesSimple" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Sl#</th>
                    <th>Name</th>
                    <th>Reg Number</th>
                    <th>No of Seat</th>
                    <th>Actions</th>
                  
                </tr>
                </thead>
                <tbody>
                  @php $sl=0 @endphp
                  @foreach ($buses as $bus)
                    <tr>
                        <td>{{ ++$sl }}</td>
                        <td>{{ $bus->name }}</td>
                        <td>{{ $bus->reg_number }}</td>
                        <td>{{ $bus->no_of_seat }}</td>
                      <td>
                        <a class="btn btn-primary" href={{ route("buses.edit", ['single_buse'=>$bus->id]) }}>Edit</a>
                        <a class="btn btn-primary" href={{ route("buses.show", ['show_buse'=>$bus->id]) }}>Show</a>


                        @can('Admin')
                            <form style="display:inline" action="{{ route('buses.destroy', ['buse' => $bus->id]) }}" method="post">
                                @csrf
                                @method('delete')

                                <button onclick="return confirm('Are you sure want to delete ?')" class="btn btn-danger" type="submit">Delete</button>
                            </form>
                            @endcan
                      </td>
                    </tr>
                @endforeach
                
                </tbody>
              </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
</x-backend.layouts.master>