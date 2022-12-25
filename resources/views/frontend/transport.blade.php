<x-frontend.layouts.master>

    <div class="container">
        <p class="text-center"
            style="padding-top:10px; padding-bottom:20px; font-family: 'Inconsolata', monospace;  font-size: 25px;
            letter-spacing: 1px;">
            Buses</p>

        <div class="row">

            @forelse ($buses as $bus)
                <div class="col-md-4 col-sm-12 col-xl-4 mb-2">
                    <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        {{-- <img src="{{ asset('images/Buses/' . json_decode($bus->images, true)[0]) }}" class="card-img-top"
                            alt="..." height="200px"> --}}
                        <div class="card-body">
                            <h5 class="card-title">{{ $bus->name }}</h5>
                            <a href="{{ route('transport_details', ['bus_id' => $bus->id]) }}"
                                class="btn btn-primary">Details</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12 col-sm-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">No Bus Found</h5>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

          <div class="row">
            <p class="text-center"
                style="padding-top:10px; padding-bottom:20px; font-family: 'Inconsolata', monospace;  font-size: 25px;
            letter-spacing: 1px;">
                Have a Look</p>
            <div class="col-md-4 col-sm-12 ">
                <iframe width="min-width" height="214" src="https://www.youtube.com/embed/pOwh5Zb9mws"
                    title="Bus #2 light show" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
            <div class="col-md-4 col-sm-12 ">
                <div class="form-group">
                    <iframe width="min-width" height="214" src="https://www.youtube.com/embed/cTa8Rgjo7lU"
                        title="Phantom Tranzit walk through video" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <iframe width="min-width" height="214" src="https://www.youtube.com/embed/5aodux5tbyA"
                    title="Bus #2 light show" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
        </div>
    <div>


</x-frontend.layouts.master>
