<x-frontend.layouts.master>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">

                <div class="card m-1 p-1" id="imageShow">
                    <img class="card-img-top" src="{{ asset('images/events/' . $event->images[0]) }}" height="300"
                        width="100%" alt="..." id="firstimg" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card m-1 p-1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h3>{{ $event->name }}</h3>

                            </div>


                        </div>

                        <hr>
                        <p>{{ $event->details }}</p>

                    </div>

                </div>
            </div>

            <div class="col-md-6">
                <div class="row ">
                    @foreach ($event->images as $image)
                        {{-- @dd($event) --}}
                        <div class="col-md-4">

                            <div class="card m-1 p-1">
                                <div class="card-body  m-1 p-1  " data-toggle='modal' data-target='#staticBackdrop'
                                    id="modalBtn">
                                    <img class="card-img-top" src="{{ asset('images/events/' . $image) }}" height="100"
                                        alt="..." />
                                </div>
                            </div>

                        </div>
                    @endforeach

                </div>
            </div>
        </div>

        <h3 class="ps-1 mt-3 mb-2 font-weight-bold text-center"><strong>Trips</strong></h3>

        <div id="accordion">
            @foreach ($event->trips as $index => $trip)
                @php
                    $trip->stoppages = json_decode($trip->stoppages, true);
                @endphp
                <div class="card mt-2">
                    <div class="card-header d-flex justify-content-between" style="background-color: #1f1252"
                        id="heading{{ $trip->id }}" data-toggle="collapse"
                        data-target="#collapse{{ $trip->id }}" aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                        aria-controls="collapse{{ $trip->id }}">
                        <h5 class="mt-1">
                            <button class="btn badge bg-info" data-toggle="collapse"
                                data-target="#collapse{{ $trip->id }}"
                                aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                aria-controls="collapse{{ $trip->id }}">
                                <i class="fas fa-plane-departure"></i>
                                {{ \Carbon\Carbon::parse($trip->start_date)->format('d M, Y') }}
                            </button>
                        </h5>
                        <h5 class="mt-1">
                            <p class="btn badge bg-danger"><i class="fas fa-bus"></i> {{ $trip->bus->name }}</p>
                        </h5>
                        <h5 class="mt-1">
                            <button class="btn badge bg-info" data-toggle="collapse"
                                data-target="#collapse{{ $trip->id }}"
                                aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                aria-controls="collapse{{ $trip->id }}">
                                <i class="fas fa-plane-arrival"></i>
                                {{ \Carbon\Carbon::parse($trip->end_date)->format('d M, Y') }}
                            </button>
                        </h5>
                    </div>

                    <div id="collapse{{ $trip->id }}" class="{{ $index == 0 ? 'collapse show' : 'collapse' }}"
                        aria-labelledby="heading{{ $trip->id }}" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="border-bottom"><strong>Trip Details</strong></h4>
                                    {{ $trip->trip_details }}
                                </div>

                                <div class="col-md-4">
                                    <h4 class="border-bottom"><strong>Stoppages</strong></h4>
                                    <ul class="list-group">
                                        @foreach ($trip->stoppages as $location => $time)
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>{{ $location }}</span><span>{{ $time }}</span></li>
                                        @endforeach
                                </div>
                            </div>
                            <div class="d-flex justify-content-end w-100">
                                <button class="btn btn-primary mt-2" onclick="modalOpen(<?php echo $trip->id; ?>)">Book a
                                    Seat</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <input type="hidden" value="{{ isset(auth()->user()->id) ? auth()->user()->id : '' }}" id="pass_id">
    <input type="hidden" value="{{ url('') }}" id="base_url">

    //Image modal
    <div class="modal" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdrop" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>

            </div>
        </div>
    </div>
    //end

    //booking modal
    <div class="modal" tabindex="-1" id="booking_modal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="name">Name</label>
                                <input class="form-control" type="text" name="name" id="name">
                            </div>
                            <div class="col-md-4">
                                <label for="phone">Phone</label>
                                <input class="form-control" type="text" name="phone" id="phone">
                            </div>
                            <div class="col-md-4">
                                <label for="address">Address</label>
                                <input class="form-control" type="text" name="address" id="address">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label for="event">Event Name</label>
                                <input class="form-control" type="text" name="event_id" id="event">
                            </div>
                            <div class="col-md-4">
                                <label for="trip">Trip Code</label>
                                <input class="form-control" type="text" id="trip">
                            </div>
                            <div class="col-md-4">
                                <label for="stoppage">Stopagges</label>
                                <select name="stoppage" id="stoppage" class="form-control">
                                    <option value="">Select One...</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="no_of_seat">Number of Seat</label>
                                <input type="number" class="form-control" id="no_of_seat" name="no_of_seat">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    //end modal
    <script>
        let images = document.querySelectorAll('.card-img-top');
        let modalBtn = document.querySelector('#modalBtn');
        let modal = document.querySelector('#staticBackdrop');
        let modalBody = document.querySelector('.modal-body');
        let modalTitle = document.querySelector('.modal-title');
        let firstImg = document.querySelector('#firstimg');
        let imageShow = document.querySelector('#imageShow');
        let modalImg = document.createElement('img');
        modalImg.setAttribute('class', 'card-img-top');
        modalImg.setAttribute('height', '300');
        modalImg.setAttribute('width', '100%');
        modalImg.setAttribute('alt', '...');
        modalImg.setAttribute('id', 'modalImg');
        modalBody.appendChild(modalImg);
        modalImg.src = firstImg.src;
        modalTitle.innerHTML = firstImg.alt;
        modalBody.style.display = 'none';
        modal.style.display = 'none';
        modalBtn.addEventListener('click', function() {
            modal.style.display = 'block';
            modalBody.style.display = 'block';
        });
        images.forEach(function(image) {
            image.addEventListener('click', function() {
                modalImg.src = image.src;
                modalTitle.innerHTML = image.alt;
            });
        });
    </script>

    <script>
        const modalOpen = (trip_id) => {
            const user_id = ($("#pass_id").val());
            if (user_id.length > 0) {
                const base_url = $("#base_url").val();
                const fethc_url = `${base_url}/get-passenger/${user_id}/${trip_id}`;
                alert(fethc_url);
                var myModal = new bootstrap.Modal(document.getElementById('booking_modal'), {
                    keyboard: false
                })
                fetch(fethc_url)
                    .then(response => response.json())
                    .then(data => {
                        console.log(Object.keys(data[1]['stoppages']));
                        $("#name").val(data[0]['name']);
                        $("#phone").val(data[0]['phone']);
                        $("#address").val(data[0]['address']);
                        $("#event").val(data[1]['event']['name']);
                        $("#trip").val(data[1]['trip_code']);
                        const stoppages = document.getElementById("stoppage");
                        stoppages.innerHTML = "";
                        let options = `<option>Choose One...</option>`;
                        // stoppages.appendChild(`<option>Choose One...</option>`);
                        const locations = Object.keys(data[1]['stoppages']);
                        const times = Object.values(data[1]['stoppages']);
                        const limit = locations.length;
                        for (let i = 0; i < limit; i++) {
                            options += (
                                `<option value="${locations[i]}-${times[i]}">${locations[i]}-${times[i]}</option>`
                                );
                        }
                        stoppages.innerHTML = options;

                    })
                myModal.show();
            } else {
                // window.location.href = "{{ URL::to('restaurants/20') }}"
            }

        }
    </script>
</x-frontend.layouts.master>
