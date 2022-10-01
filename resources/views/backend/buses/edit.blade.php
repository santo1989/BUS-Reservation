<x-backend.layouts.master>
  <x-slot name="pageTitle">
     Edit Bus Information
  </x-slot>

  <x-slot name='breadCrumb'>
    <x-backend.layouts.elements.breadcrumb>
        <x-slot name="pageHeader"> Bus </x-slot>
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('buses.index') }}">Bus</a></li>
        <li class="breadcrumb-item active">Edit Bus Information</li>
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
<form action="{{ route('buses.update', ['single_buse' => $single_buse->id]) }}" method="post" enctype="multipart/form-data">
  <div>
      @csrf
      @method('post')
      <x-backend.form.input name="name" type="text" label="Name" :value="$single_buse->name"/>
        <br>
      <x-backend.form.input name="reg_number" type="text" label="Registration Number" :value="$single_buse->reg_number"/>
        <br>
      <x-backend.form.input name="no_of_seat" type="number" label="Number of Seat" :value="$single_buse->no_of_seat"/>
        <br>
      {{-- <x-backend.form.input name="left_part" type="number" label="Left Part" :value="$single_buse->left_part"/>
        <br>
      <x-backend.form.input name="right_part" type="number" label="Rigt Part" :value="$single_buse->right_part"/> --}}
        <br>

      <x-backend.form.button>Save</x-backend.form.button>    </div>
</form>


</x-backend.layouts.master>


