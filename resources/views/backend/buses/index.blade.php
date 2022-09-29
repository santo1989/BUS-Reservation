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

              <table id="example2" class="table table-bordered table-hover">
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
                        <a class="btn btn-primary" href={{ route("buses.edit", ['bus_id'=>$bus->id]) }}>Edit</a>
                        <form action={{ route("buses.destroy", $bus->id) }} method="POST" class="d-inline">
                          @csrf
                          @method("DELETE")
                          <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
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