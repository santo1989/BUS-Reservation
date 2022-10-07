<x-frontend.layouts.master>
  @php
    $index = ceil(count($bus->images)/2);
    $featured = explode('. ', $bus->features_details);
    $other_details = explode('. ', $bus->other_details);
  @endphp
  <div class="container">
    <div class="row">
      @for($i = 0; $i < $index; $i++) 
      <div class="col-md-4 col-sm-4 col-xl-4 mb-1">
        <div class="card">
           <img src="{{ asset('images/Buses/'.$bus->images[$i]) }}" class="card-img-top" alt="..." height="200" width="100%">
        </div>
      </div>
      @endfor
    </div>
    <div class="row mt-3">
      <div class="col-md-6 col-sm-12 col-xl-6 mb-1">
        <div class="card">
          <div class="card-header">
            <h4 class="text-center">Features</h4>
          </div>
          <div class="card-body">
            <ul class="list-group">
              @foreach($featured as $feature)
              <li class="list-group-item">{{ $feature }}</li>
              @endforeach
            </ul>
          </div>
        
        </div>
     </div>
      <div class="col-md-6 col-sm-12 col-xl-6">
        <div class="card">
          <div class="card-header">
            <h4 class="text-center">Other Details</h4>
          </div>
          <div class="card-body">
            <ul class="list-group">
              @foreach($other_details as $other_detail)
              <li class="list-group-item">{{ $other_detail }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      @for($i = $index ; $i < count($bus->images); $i++) 
      <div class="col-md-4 col-sm-4 col-xl-4 mb-1">
        <div class="card">
           <img src="{{ asset('images/Buses/'.$bus->images[$i]) }}" class="card-img-top" alt="..." height="200" width="100%">
        </div>
      </div>
      @endfor
    </div>
  </div>

</x-frontend.layouts.master>