<x-backend.layouts.master>
  <x-slot name="pageTitle">
     Bus Inforomation
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

          </div>
          <!-- /.card-header -->
          <div class="card-body">
              {{-- bus Table goes here --}}
              <table class="table table-bordered">
                <tr>
                    <th>Name</th>
                    <td>{{ $show_buse->name }}</td>
                </tr>
                <tr>
                    <th>BUS Number</th>
                    <td>{{ $show_buse->reg_number }}</td>
                </tr>
                <tr>
                    <th>Number of Seat</th>
                    <td>{{ $show_buse->no_of_seat }}</td>
                </tr>
                <tr>
                    <th>Features Details</th>
                    <td>{{ $show_buse->features_details }}</td>
                </tr>
                <tr>
                    <th>Other Details</th>
                    <td>{{ $show_buse->other_details }}</td>
                </tr>

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