<x-frontend.layouts.master>
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

                    <div class="card m-1 p-1" id="myImg">
                        <img class="card-img-top" src="{{ asset('images/events/' . $event->images) }}" height="300"
                            width="100%" alt="..." />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card m-1 p-1">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h3>{{ $event->name }}</h3>

                                </div>


                            </div>

                            <hr>
                            <p>{{ $event->details }}</p>

                        </div>

                    </div>
                </div>

            </div>

            <h3 class="ps-1 mt-3 mb-2 font-weight-bold text-center"><strong>Trips</strong></h3>


            <x-backend.layouts.elements.errors :errors="$errors" />
            @php
                $count = 0;
            @endphp
            @forelse ($dates as $index=>$date)
                <div id="accordion">                    
                    <div class="card mt-2">
                        <div class="card-header d-md-flex justify-content-center" style="background-color: #1f1252"
                            id="heading{{ $date[0]->start_date }}" data-toggle="collapse"
                            data-target="#collapse{{ $date[0]->start_date }}"
                            aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                            aria-controls="collapse{{ $date[0]->start_date }}">
                        
                            <h5 class="mt-1">
                                <button class="btn badge bg-danger" data-toggle="collapse"
                                    data-target="#collapse{{ $date[0]->start_date }}"
                                    aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                    aria-controls="collapse{{ $date[0]->start_date }}">
                                    <i class="fas fa-plane-departure"></i>
                                    {{ \Carbon\Carbon::parse($date[0]->start_date)->format('d M, Y') }}
                                </button>
                            </h5>
                         
                        </div>
                        <div id="collapse{{ $index }}" class="{{ $count == 0 ? 'collapse show' : 'collapse' }}"
                            aria-labelledby="heading{{ $date[0]->id }}" data-parent="#accordion">
                            <div class="card-body">


                                <div class="row">
                                    <ul class="list-group">
                                        @foreach ($date as $trip)
                                            @php
                                                $trip->stoppages = json_decode($trip->stoppages, true);
                                                
                                            @endphp
                                            @foreach ($trip->stoppages as $location => $time)
                                                <li class="list-group-item">
                                                    <div class="row border-bottom mt-1 mb-1">
                                                        <strong>{{ $trip->trip_details }}</strong>
                                                    </div>
                                                    <div class="d-md-flex justify-content-between">
                                                        <div>
                                                            <span>{{ $timeFormat == 24 ? $time : changeFormat($time) }}</span> -
                                                            <span>{{ $location }}</span>
                                                        </div>

                                                        <button class="btn btn-primary mt-2"
                                                            onclick="modalOpen(<?php echo $trip->id; ?>)">Book a
                                                            Seat</button>
                                                    </div>
                                            @endforeach
                                        @endforeach
                                </div>
                             
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $count++;
                @endphp
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
        aria-labelledby="staticBackdrop" aria-hidden="false" style=" height: 100vh";>
        <div class="modal-dialog" style="width: 100% !important; height: 100% !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Image</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>

            </div>
        </div>
    </div>
    {{-- Image modal --}}
    {{-- image modal script --}}
    <script>
        let images = document.querySelectorAll('.card-img-top');
        let modalBtn = document.querySelector('#modalBtn');
        let modal = document.querySelector('#staticBackdrop');
        let modalBody = document.querySelector('.modal-body');
        let modalTitle = document.querySelector('.modal-title');
        let firstImg = document.querySelector('#myImg');
        let imageShow = document.querySelector('#imageShow');
        let modalImg = document.createElement('img');
        modalImg.setAttribute('height', '95%');
        modalImg.setAttribute('width', '95%');
        modalImg.setAttribute('id', 'modalImg');
        modalBody.appendChild(modalImg);
        images.forEach((image) => {
            image.addEventListener('click', (e) => {
                modalImg.setAttribute('src', e.target.src);
                modalTitle.innerHTML = e.target.alt;
                modal.style.display = 'block';
            });
        });
        modal.addEventListener('click', (e) => {
            if (e.target.classList.contains('btn-close')) {
                modal.style.display = 'none';
            }
        });
    </script>

    {{-- end booking modal --}}
    <div class="modal" tabindex="-1" id="booking_modal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form action="{{ route('newBooking') }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Book a Seat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <label for="stoppage" id="selectnew">Shuttle Place and Time</label>
                                <select name="stoppage" id="stoppage" class="form-control">
                                    {{-- <option value="">Select One...</option> --}}
                                </select>
                                {{-- <input class="form-control" type="text" name="stoppage" id="stoppage" required
                                    readonly> --}}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label for="no_of_seat">Number of Seats</label>
                                <input type="number" class="form-control" id="no_of_seat" name="no_of_seat"
                                    required>
                            </div>
                            <div class="col-md-4" id="available_seats">
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
        let a_seat;
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
                         console.log(data);
                        $("#name").val(data[0]['name']);
                        $("#phone").val(data[0]['phone']);
                        $("#address").val(data[0]['address']);
                        $("#event").val(data[1]['event']['name']);
                        $("#trip").val(data[1]['trip_code']);
                        $("#trip_id").val(data[1]['id']);
                        $("#passenger_id").val(data[0]['id']);
                        $("#event_id").val(data[1]['event_id']);
                        
                        a_seat = data[1]['available_seats'];
                        // console.log(a_seat);
                        // let time_format = document.getElementById("time_format");
                        // time_format.addEventListener('change', function() {
                        //     alert("Check");
                        //     console.log(this.value);
                        //     makeStopageTimeformat(this.value);
                        // });
                        
                        const time_format = "<?php echo $timeFormat; ?>";
                        // alert(time_format);
                        makeStopageTimeformat(time_format+'');

                        function changeFormat(time) {
                            hour = time.split(":")[0];
                            minute = time.split(":")[1];
                            ampm = '';

                            if (hour > 12) {
                                hour = hour - 12;
                                ampm = "pm"
                            } else if (hour == '00') {
                                hour = 12;
                                ampm = "am"
                            } else {
                                hour = hour;
                                ampm = "am";
                            }
                            return `${hour}:${minute} ${ampm}`;
                        };

                        function makeStopageTimeformat(time_format) {
                            const stoppages = document.getElementById("stoppage");
                            stoppages.innerHTML = "";
                            let options = '';
                            const locations = Object.keys(data[1]['stoppages']);
                            const times = Object.values(data[1]['stoppages']);
                            const limit = locations.length;

                            console.log("Check");
                            console.log(data[1]['stoppages']);


                            for (let i = 0; i < limit; i++) {
                                if (time_format == '24') {

                                    options +=
                                        `<option value="${locations[i]} - ${times[i]}">${locations[i]} - ${times[i]}</option>`;
                                } else {
                                    console.log(times[i]);

                                    newtime = changeFormat(times[i]);
                                    newTimeForValue = times[i];

                                    options +=
                                        `<option value="${locations[i]} - ${newTimeForValue}">${locations[i]} - ${newtime}</option>`;

                                }

                            }
                            stoppages.innerHTML = options;
                        }


                        if (a_seat < 6) {
                            document.getElementById('available_seats').innerHTML =
                                ` <div class="rounded bg-danger text-white p-2 mt-4">Available Seats: ` + a_seat +
                                `</div>`;
                        } else {
                            document.getElementById('available_seats').innerHTML =
                                ` <div class="rounded bg-success text-white p-2 mt-4">Available Seats: ` + a_seat +
                                `</div>`;
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
        let seat = <?php echo $seat; ?>;
        let seat_old = document.getElementById('no_of_seat');
        let newSeat = document.getElementById('available_seats').innerHTML = " ";
        newSeat = document.getElementById('available_seats').innerHTML =
            ` <div class="rounded bg-success text-white p-2 mt-4">Available Seats: ${seat}</div>`;
        seat_old.addEventListener('change', function() {
            if (seat_old.value > 0 && seat_old.value <= seat) {
                let seat_new = a_seat - seat_old.value;
                console.log(seat_new);
                if (seat_new < 6) {
                    newSeat = document.getElementById('available_seats').innerHTML =
                        ` <div class="rounded bg-danger text-white p-2 mt-4">Available Seats: ${seat_new}</div>`;
                } else {
                    newSeat = document.getElementById('available_seats').innerHTML =
                        ` <div class="rounded bg-success text-white p-2 mt-4">Available Seats: ${seat_new}</div>`;
                }
            } else {
                alert('Please enter valid number of seats');
                document.getElementById('available_seats').innerHTML = " ";
            }

        });
    </script>

</x-frontend.layouts.master>
