@switch(auth()->user()->role->name)
  @case('Admin')
<x-backend.layouts.master>

    <x-slot name="pageTitle">
      Admin Dashboard
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Dashboard </x-slot>
            <li class="breadcrumb-item active">Dashboard</li>
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>


       <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Driver Assign to Bus</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('drivers.index')}}">Driver Entry</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
       </div>
     


</x-backend.layouts.master>

@break

@case('Driver')
<x-backend.layouts.master>
  <div class="m-5">
    <h3>Welcome, 
      @php
        echo auth()->user()->name ;
      @endphp !
      </h3>
  </div>
  
  {{-- @php
    $driver = App\Models\Driver::where('user_id', auth()->user()->id)->first();
  $trip_table = App\Models\Trip::where('driver_id', $driver->id )->get();
  // dd($trip_table);
  $passenger_id = App\Models\Booking::where('trip_id', $trip_table->id)->get();
    $passanger = App\Models\Passenger::where('id', $passenger_id->passenger_id)->get();
    dd($passanger);
  @endphp --}}
</x-backend.layouts.master>
@break

@case('Guest')
<x-backend.layouts.master>
  <x-slot name="pageTitle">
          Guest Portal
      </x-slot>
  
      <x-slot name='breadCrumb'>
          <x-backend.layouts.elements.breadcrumb>
              <x-slot name="pageHeader"> Welcome, {{ auth()->user()->name }} </x-slot>
              
          </x-backend.layouts.elements.breadcrumb>
      </x-slot>
      <div class="col-md-12"><i class="fas fa-tachometer-alt"></i>
      Waiting for Cooridinator Conformation
    </div>
 
    {{-- </div> --}}
  </x-backend.layouts.master>
  @break

@default

<x-backend.layouts.master>
 

  </x-backend.layouts.master>

@endswitch

<script>
      // $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })

    $('#reservation').daterangepicker()

  //   Date picker JS
</script>
{{-- @endif --}}