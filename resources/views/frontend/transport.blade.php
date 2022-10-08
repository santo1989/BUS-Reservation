<x-frontend.layouts.master>

<div class="container">
    <h4 class="text-center mb-2"><strong>Buses</strong></h4>
    <div class="row">
      @forelse ($buses as $bus)
        <div class="col-md-4 col-sm-12 col-xl-4">
          <div class="card" style="width: 18rem;">
            {{-- <img src="..." class="card-img-top" alt="..."> --}}
            <img src="{{ asset('images/Buses/'.json_decode($bus->images,true)[0]) }}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{ $bus->name }}</h5>
              <a href="{{ route('transport_details',['bus_id'=>$bus->id]) }}" class="btn btn-primary">Details</a>
            </div>
          </div>
        </div>
      @empty
        <div class="col-md-12 col-sm-12 col-xl-12">
          <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">No Bus Found</h5>
            </div>
          </div>
        </div>
      @endforelse
    </div>
<div>


</x-frontend.layouts.master>