<x-frontend.layouts.master>

 
    <div class="container">
        @if(is_null($bookings) || empty($bookings))    
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <h1 class="text-danger"> <strong>You do not have any booking currently!</strong> </h1>
            </div>
        </div>
        @else
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Booking</h3>
                        </div>
                        <div class="card-body">
                            <from action="{{ route('front_booking', ['booking_id', $booking->id]) }}" method="put">
                                @csrf
                                <div class="form-group">
                                    <label for="no_of_seat">No of Seat</label>
                                    <input type="number" name="no_of_seat" id="no_of_seat" class="form-control" value="{{ $booking->no_of_seat }}">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </from>
                            {{-- <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                            <div class="form-group">
                                <label for="no_of_seat">Booked Seat</label>
                                <select name="no_of_seat" id="no_of_seat" class="form-control">
                                    <option value="">Select Booked Seat</option>
                                    @foreach ($trips as $trip)
                                        <option value="{{ $trip->id }}" {{ $trip->id == $booking->trip->id ? 'selected' : '' }}>{{ $trip->no_of_seat }}</option>
                                    @endforeach
                                </select>
                               
                            </div>
                            <div class="form-group">
                                <label for="stoppages">shuttle time</label>
                                <select name="stoppages" id="stoppages" class="form-control">
                                    <option value="">Select shuttle time</option>
                                    @foreach ($trips as $trip)
                                        <option value="{{ $trip->id }}" {{ $trip->id == $booking->trip->id ? 'selected' : '' }}>{{ $trip->stoppages }}</option>
                                    @endforeach
                                </select> --}}
                               
                            </div>
                    </div>
                </div>
            </div>
        </div>

        @endif

    </x-frontend.layouts.master>