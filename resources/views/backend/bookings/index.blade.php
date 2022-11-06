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
      @if (is_null($evs) || empty($evs))
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <h1 class="text-danger"> <strong>Currently No Information Available!</strong> </h1>
                </div>
            </div>
        @else

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
                @foreach($evs as $index => $event)
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
                            <th scope="col">Trip Code</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          {{-- @dd($event->trips) --}}
                          @foreach ($event->trips as $index => $trip)
                            <tr>
                              <th scope="row">{{ $index+1 }}</th>
                              <th>{{ $trip->trip_code }}</th>
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

  {{-- Data show --}}
  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">          
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-User" id="book_table">
              
              

            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
    {{-- Data show --}}

    {{-- Edit Modal --}}

    {{-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Booking</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
          </div>
        </div>
      </div>
    </div> --}}

  <script>
    const getBookings = (trip_id) => {
      const base_url = $('#base_url').val();
      const fethc_url = `${base_url}/get-bookings/${trip_id}`;
      fetch(fethc_url)
      .then(response => response.json())
      .then(data => {console.log(data)
        const { bookings } = data;
        const table = document.getElementById('book_table');
        table.innerHTML = '';
        const thead = document.createElement('thead');
        const tr = document.createElement('tr');
        const th1 = document.createElement('th');
        th1.innerHTML = 'Sl';
        const th2 = document.createElement('th');
        th2.innerHTML = 'Name';
        const th3 = document.createElement('th');
        th3.innerHTML = 'Phone';
        const th4 = document.createElement('th');
        th4.innerHTML = 'Stopage';
        const th5 = document.createElement('th');
        th5.innerHTML = 'No of Seat';
        const th6 = document.createElement('th');
        th6.innerHTML = 'Action';
        tr.append(th1, th2, th3, th4, th5, th6);
        thead.append(tr);
        table.append(thead);
        const tbody = document.createElement('tbody');
     
        data.map((booking, index) => {
          const tr = document.createElement('tr');
          const td1 = document.createElement('td');
          td1.innerHTML = index + 1;
          const td2 = document.createElement('td');
          td2.innerHTML = booking.passenger.name;
          const td3 = document.createElement('td');
          td3.innerHTML = booking.passenger.phone;
          const td4 = document.createElement('td');
          td4.innerHTML = booking.stoppage;
          const td6 = document.createElement('td');
          td6.innerHTML = booking.no_of_seat;
          const td5 = document.createElement('td');
          const a = document.createElement('a');
          a.href = `${base_url}/bookings/edit/${booking.id}`;
          
          a.setAttribute('class', 'btn btn-sm btn-info');
          a.innerHTML = 'Edit';
          
          const deleteForm = document.createElement("form");
          deleteForm.setAttribute('action', `${base_url}/bookings/delete/${booking.id}`);
          deleteForm.setAttribute('method', 'POST');
          deleteForm.innerHTML = 
          `@csrf
           @method('delete')
          `;
          const deleteButton = document.createElement('button');
          deleteButton.setAttribute('type', 'submit');
          deleteButton.setAttribute('class', 'btn btn-sm btn-danger');
          deleteButton.onclick = () => confirm('Are you sure you want to delete this');
          deleteButton.innerHTML = 'Delete';

          deleteForm.appendChild(deleteButton);

          const btnDiv = document.createElement('div');
          btnDiv.setAttribute('class', 'd-flex justify-content-around');

          btnDiv.appendChild(a);
          btnDiv.appendChild(deleteForm);
          
          td5.appendChild(btnDiv);
          tr.append(td1, td2, td3, td4, td6, td5);
          tbody.append(tr);
        });
        table.append(tbody);
        
      });
    }
  </script>
@endif
</x-backend.layouts.master>