<x-frontend.layouts.master>

    <x-backend.layouts.elements.message :fmessage="session('message')" />
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Booking</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('updateBooking', ['id' => $booking->id]) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">

                                <div class="col-md-6">
                                    <label for="no_of_seat">No of Seat</label>
                                    <input type="number" name="no_of_seat" id="no_of_seat" class="form-control"
                                        value="{{ $booking->no_of_seat }}">

                                </div>

                                <div class="col-md-6" id="available_seats">

                                </div>
                            </div>
                            <br>
                         {{--    <div class="row">
                                <div class="col-md-6">
                                    <label for="time_format">Select Time Format</label>
                                    <select name="time_format" id="time_format" class="form-control" required>
                                        <option value="">Choose One...</option>
                                        <option value="24">24 Hours</option>
                                        <option value="12">12 Hours</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <label for="stoppages">Shuttle Time</label>
                                        <select name="stoppage" id="stoppages" class="form-control" required>
                                            @php
                                                $stoppages = json_decode($booking->trip->stoppages);
                                                
                                            @endphp

                                            @foreach ($stoppages as $key => $stoppage)
                                                <option value="{{ $key }}-{{ $stoppage }}"
                                                    {{ $key == $booking->stoppages ? 'selected' : '' }}>
                                                    {{ $key }}-{{ $stoppage }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> 
                            </div>--}}


                            <input type="hidden" name="trip_id" id="trip_id" value="{{ $booking->trip->id }}">
                            <br>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <script>
        let time_format = document.getElementById("time_format");
        time_format.addEventListener('change', function() {
            console.log(this.value);
            makeStopageTimeformat(this.value);

        });

        function makeStopageTimeformat(time_format) {
            let stoppagesSelectForm = document.getElementById("stoppages");
            let stoppages = <?php echo json_encode($stoppages, true); ?>;
            console.log(stoppages);
            let option = document.createElement('option');
            option = '';
            for (stoppage in stoppages) {
                console.log(stoppages[stoppage]);

                let stoppageTime = stoppages[stoppage].split(' ')[0];
                // console.log(stoppageTime);
                let stoppageTimeArray = stoppageTime.split(':');
                // console.log(stoppageTimeArray);
                let hour = stoppageTimeArray[0];
                // console.log(hour);
                let minute = stoppageTimeArray[1];
                // console.log(minute);
                // let second = stoppageTimeArray[2];
                let ampm = stoppages[stoppage].split(' ')[1];
                if (time_format == 24) {
                       alert(parseInt(hour) + 12);

                    hour = parseInt(hour) + 12;
                    if(hour == 24){
                        hour = '00';
                    }
                    ampm = '';
                    // let stoppageTimeFormat = hour + ':' + minute + ' ' + ampm;
                    // stoppages.value = stoppageArray[0] + '-' + stoppageTimeFormat;
                }


                option +=
                    `<option value="${stoppage}-${hour}:${minute} ${ampm}">${stoppage}-${hour}:${minute} ${ampm}</option>`;

            }
            stoppagesSelectForm.innerHTML = option;

        }
    </script> --}}
    <script>
        let seat = <?php echo $trip->available_seats; ?>;
        let book_seat = <?php echo $booking->no_of_seat; ?>;
        let seat_old = document.getElementById('no_of_seat');
        let newSeat = document.getElementById('available_seats').innerHTML = " ";
        newSeat = document.getElementById('available_seats').innerHTML =
            ` <div class="rounded bg-success text-white p-2 mt-4">Available Seats: ${seat}</div>`;

        seat_old.addEventListener('change', function() {
            if (seat_old.value > 0) {
                let seat_new = seat + book_seat - seat_old.value;
                if (seat_new < 0) {
                    alert('Please enter valid number of seats');
                    document.getElementById('available_seats').innerHTML =
                        ` <div class="rounded bg-success text-white p-2 mt-4">Available Seats: ${seat}</div>`;
                    seat_old.value = book_seat;
                } else {
                    if (seat_new < 6) {
                        newSeat = document.getElementById('available_seats').innerHTML =
                            ` <div class="rounded bg-danger text-white p-2 mt-4">Available Seats: ${seat_new}</div>`;

                    } else {
                        newSeat = document.getElementById('available_seats').innerHTML =
                            ` <div class="rounded bg-success text-white p-2 mt-4">Available Seats: ${seat_new}</div>`;
                    }
                }
            } else {
                alert('Please enter valid number of seats');
                document.getElementById('available_seats').innerHTML =
                    ` <div class="rounded bg-success text-white p-2 mt-4">Available Seats: ${seat}</div>`;
                seat_old.value = book_seat;
            }


        });
    </script>
</x-frontend.layouts.master>
