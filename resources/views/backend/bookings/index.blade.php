<x-backend.layouts.master>
  <x-slot name="pageTitle">
     Booking List
  </x-slot>

  <x-slot name='breadCrumb'>
    <x-backend.layouts.elements.breadcrumb>
        <x-slot name="pageHeader"> Booking </x-slot>
        <li class="breadcrumb-item"><a href="{{ route('bookings.index') }}">Booking</a></li>
    </x-backend.layouts.elements.breadcrumb>
  </x-slot>

  <section class="content">
    <div class="container-fluid">

    @if (session('message'))
    <div class="alert alert-success">
        <span class="close" data-dismiss="alert">&times;</span>
        <strong>{{ session('message') }}.</strong>
    </div>
    @endif

      <input type="hidden" value="{{ url('') }}" id="base_url">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <a class="btn btn-primary" href={{ route("bookings.create") }}>Create</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div id="accordion">
                @foreach($events as $index => $event)
                <div class="card mt-2">
                  <div class="card-header d-flex justify-content-between" id="heading{{ $event->id }}">                  
                    <h5 class="mb-0">
                      <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $event->id }}" aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $event->id }}">
                        {{ $event->name }}
                      </button>
                    </h5>
                    <h5 class="mt-1">Total Trip - {{ $event->trip_count }}</h5>
                  </div>

                  <div id="collapse{{ $event->id }}" class="{{ $index == 0 ? 'collapse show' : 'collapse' }}" aria-labelledby="heading{{ $event->id }}" data-parent="#accordion">
                    <div class="card-body">
                      <table class="table table-dark">
                        <thead>
                          <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($event->trips as $index => $trip)
                            <tr>
                              <th scope="row">{{ $index+1 }}</th>
                              <td>{{ $trip->start_date }}</td>
                              <td>{{ $trip->end_date }}</td>
                              <td><button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="getBookings(<?php echo $trip->id;  ?>)">Show Bookings</button></td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                @endforeach              
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>

  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    {{-- <script>
      function getBookings(trip_id) {
        var base_url = $('#base_url').val();
        $.ajax({
          url: base_url + '/bookings/getBookings',
          type: 'GET',
          data: {
            trip_id: trip_id
          },
          success: function (data) {
            $('.modal-body').html(data);
          }
        });
      } --}}
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    const getBookings = (trip_id) => {
      const base_url = $('#base_url').val();
      const fethc_url = `${base_url}/get-bookings/${trip_id}`;
      fetch(fethc_url)
      .then(response => response.json())
      .then(data => {console.log(data)
  
      })
      // alert(fethc_url);
    }
  </script>

</x-backend.layouts.master>