<x-frontend.layouts.master>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    
    <div class="container">
        @if (is_null($trips) || empty($trips))
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <h1 class="text-danger"> <strong>Currently No Information Available!</strong> </h1>
                </div>
            </div>
        @else
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
                                    <img class="card-img-top" src="{{ asset('images/events/' . $image) }}"
                                        height="100" alt="..." />
                                </div>
                            </div>

                        </div>
                    @endforeach

                </div>
            </div>
        </div>

        <h3 class="ps-1 mt-3 mb-2 font-weight-bold text-center"><strong>Trips</strong></h3>
        <x-backend.layouts.elements.errors :errors="$errors" />
        <div id="accordion">
            @forelse ($event->trips as $index => $trip)
                @php
                    $trip->stoppages = json_decode($trip->stoppages, true);
                @endphp
                <div class="card mt-2">
                    <div class="card-header d-md-flex justify-content-between" style="background-color: #1f1252"
                        id="heading{{ $trip->id }}" data-toggle="collapse"
                        data-target="#collapse{{ $trip->id }}" aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                        aria-controls="collapse{{ $trip->id }}">
                        <h5 class="mt-1">
                            <p class="btn badge bg-danger">
                                {{ $trip->trip_code }}</p> 
                                {{-- @php 
                                $trip_code = explode('-', $trip->trip_code);
                                $trip_code1 = explode('_', $trip_code[0]); 
                                $trip_code_2 = explode('_', $trip->trip_code);
                                $trip_code_3 = explode('_', $trip_code_2[2]);
                                $trip_code3 = explode('-', $trip_code_3[0]);
                                // dd($trip_code3);
                                @endphp
                                {{ $trip_code1[2] }}_{{ $trip_code1[0] }}_{{ $trip_code1[1] }}_{{$trip_code3[1]}}_{{$trip_code3[2]}}
                            </p> --}}
                        </h5>
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
                            <div class="row border-bottom mt-1 mb-1">
                                {{-- <h4 class="border-bottom"> </h4> --}}
                                {{ $trip->trip_details }}
                            </div>

                            <div class="row">
                                
                                
                                 <div class="col-md-8 col-sm-8">
                                    {{-- <h4 class="border-bottom"><strong></strong></h4> --}}
                                    <ul class="list-group">
                                        @foreach ($trip->stoppages as $location => $time)
                                            <li class="list-group-item">    
                                                @php
                                                    $time = \Carbon\Carbon::parse($time)->format('h:i A');
                                                @endphp       
                                             <span>{{ $time }}</span> Shuttle to <span>{{ $location }}</span>
                                        @endforeach
                                </div>

                             <div class="col-md-4 col-sm-4">
                                    <div class="d-flex justify-content-end w-100">
                                <button class="btn btn-primary mt-2" onclick="modalOpen(<?php echo $trip->id; ?>)">Book a
                                    Seat</button>
                            </div>
                                </div> 
                            </div>
                            {{--   <div class="d-flex justify-content-end w-100">
                                <button class="btn btn-primary mt-2" onclick="modalOpen()">Book a
                                    Seat</button>
                            </div>--}}
                        </div>
                    </div>
                </div>
            @empty
                <div class=" text-center">
                    <h3>No Trips Found</h3>
                </div>
            @endforelse
        </div>

    </div>

    @php
        $user_id = session('user')->id ?? '';
    @endphp

    <input type="hidden" value="{{ $user_id }}" id="user_id">
    <input type="hidden" value="{{ url('') }}" id="base_url">

    {{-- Image modal --}}
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
    {{-- end booking modal --}}
    <div class="modal" tabindex="-1" id="booking_modal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form action="{{ route('newBooking') }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Book a Seat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-4">
                                <label for="name">Name</label>
                                <input class="form-control" type="text" name="name" id="name" required
                                    readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="phone">Phone</label>
                                <input class="form-control" type="text" name="phone" id="phone" required
                                    readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="address">Address</label>
                                <input class="form-control" type="text" name="address" id="address" required
                                    readonly>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label for="event">Event Name</label>
                                <input class="form-control" type="text" id="event" required readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="trip">Trip Code</label>
                                <input class="form-control" type="text" id="trip" required readonly>
                            </div>

                            <div class="col-md-4">
                                <label for="stoppage">Shuttle Place and Time</label>
                                <select name="stoppage" id="stoppage" class="form-control" required>
                                    <option value="">Select One...</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="no_of_seat">Number of Seats</label>
                                <input type="number" class="form-control" id="no_of_seat" name="no_of_seat"
                                    required>
                            </div>
                            <div class="col-md-6" id="available_seats">
                                <div class="rounded bg-success text-white p-2 mt-4">
                                    Available Seats: ${seat}

                                </div>
                            </div>

                        </div>
                        <input type="hidden" name="trip_id" id="trip_id">
                        <input type="hidden" name="passenger_id" id="passenger_id">
                        <input type="hidden" name="event_id" id="event_id">


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Book</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endif
    @forelse ($trips as $trip)
        @php
            $seat = 0;
            //   dd($seat);
            
            $seat = $trip->available_seats;
            //   dd($seat);
            
            $seat = $seat - $trip->booked_seats;
            //   dd($seat);
        @endphp
    @empty
        @php
            $seat = 0;
        @endphp
    @endforelse
    {{-- //end modal --}}
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
            const user_id = ($("#user_id").val());
            if (user_id.length > 0) {
                const base_url = $("#base_url").val();
                const fethc_url = `${base_url}/get-passenger/${user_id}/${trip_id}`;
                // alert(fethc_url);
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
                        $("#trip_id").val(data[1]['id']);
                        $("#passenger_id").val(data[0]['id']);
                        $("#event_id").val(data[1]['event_id']);
                        var seats = data[1]['available_seats'];
                       
                        const stoppages = document.getElementById("stoppage");
                        stoppages.innerHTML = "";
                        let options = `<option label="Choose One..." disabled selected></option>`;
                        // stoppages.appendChild(`<option>Choose One...</option>`);
                        const locations = Object.keys(data[1]['stoppages']);
                        const times = Object.values(data[1]['stoppages']);
                        // console.log(locations, times);
                        const limit = locations.length;
                        for (let i = 0; i < limit; i++) {
                            options += (
                                `<option value="${locations[i]}-${times[i]}">${locations[i]}-${times[i]}</option>`
                            );
                        }
                        stoppages.innerHTML = options;
                        if(seats<6)
                        {
                            document.getElementById('available_seats').innerHTML =
                        ` <div class="rounded bg-danger text-white p-2 mt-4">Available Seats: `+seats+`</div>`;
                        }
                        else{
                            document.getElementById('available_seats').innerHTML =
                        ` <div class="rounded bg-success text-white p-2 mt-4">Available Seats: `+seats+`</div>`;
                        }
                     
                    })
                myModal.show();
            } else {
                const ans = confirm("You have to log in first. Login now?");
                if (ans == true) {
                    window.location.href = "{{ URL::to('/passenger-login') }}";
                }
            }

        }
    </script>

    <script>
        let seat = <?php echo $seat; ?>;
        let seat_old = document.getElementById('no_of_seat');
        let newSeat = document.getElementById('available_seats').innerHTML = " ";
        newSeat = document.getElementById('available_seats').innerHTML =
            ` <div class="rounded bg-success text-white p-2 mt-4">Available Seats: ${seat}</div>`;
        seat_old.addEventListener('change', function() {
            if (seat_old.value > 0 && seat_old.value <= seat) {
                let seat_new = seat - seat_old.value;
                if (seat_new < 6) {
                    newSeat = document.getElementById('available_seats').innerHTML =
                        ` <div class="rounded bg-danger text-white p-2 mt-4">Available Seats: ${seat_new}</div>`;
                } else {
                    newSeat = document.getElementById('available_seats').innerHTML =
                        ` <div class="rounded bg-success text-white p-2 mt-4">Available Seats: ${seat_new}</div>`;
                }
            } else {
                alert('Please enter valid number of seats');
                //   document.getElementById('available_seats').removeChild(p);
                document.getElementById('available_seats').innerHTML = " ";
            }

        });
    </script>

</x-frontend.layouts.master>
