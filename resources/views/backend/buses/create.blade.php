<x-backend.layouts.master>
    <x-slot name="pageTitle">
       Create Bus
    </x-slot>

    <x-slot name='breadCrumb'>
      <x-backend.layouts.elements.breadcrumb>
          <x-slot name="pageHeader"> Bus </x-slot>
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('buses.index') }}">Bus</a></li>
          <li class="breadcrumb-item active">Create Bus</li>
      </x-backend.layouts.elements.breadcrumb>
  </x-slot>


  @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
  @endif
  <form action="{{ route('buses.store') }}"  method="post">
    <div>
        @csrf

        <x-backend.form.input name="name" type="text" label="Name"/>
        <x-backend.form.input name="reg_number" type="text" label="Registration Number"/>
         <x-backend.form.input name="no_of_seat" type="number" label="Number of Seat"/>
       {{-- <x-backend.form.input name="left_part" type="number" label="Right Side Seat"/>
        <x-backend.form.input name="right_part" type="number" label="Left Side Seat"/> --}}

        <x-backend.form.button>Save</x-backend.form.button>    </div>
</form>


</x-backend.layouts.master>


