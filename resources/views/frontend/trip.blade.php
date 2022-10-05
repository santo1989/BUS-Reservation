        <x-frontend.layouts.master>

        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

        <p class="text-center"
        style="padding-top:10px; padding-bottom:20px; font-family: 'Inconsolata', monospace;  font-size: 25px;
            letter-spacing: 1px; border: 2px solid black">TAKE A TRIP</p>
        <table class="table table-dark table-striped">
        <thead>
        <!-- <tr>
        <th scope="col">Book a Seat</th>
        </tr> -->
        </thead>
        <tbody>
        <tr>


        <td>

        <p>
        <a class="btn btn-outline-light" data-bs-toggle="collapse" href="#multiCollapseExample1"
        role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Somudro
        Bilash</a>
        </p>
        <div class="row">
        <div class="col">
        <div class="collapse multi-collapse" id="multiCollapseExample1">
        <div class="card card-body">
        <table class="table">
        <thead>
        <tr>
        <th scope="col">SL</th>
        <th scope="col">Trip Code</th>
        <th scope="col">Start Date</th>
        <th scope="col">End Date</th>
        <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>Otto</td>
        <td>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-sm btn-warning"
        data-toggle="modal" data-target=".bd-example-modal-lg"
        onclick="myfunction()">Show Bookings</button>
        </td>

        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1"
        role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-lg">
        <div class="modal-content text-dark">
        <div class="modal-header">
        <h5 class="modal-title " id="bd-example-modal-lg">Trip Booking
        </h5>
         <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="">
        <div class="container-fluid">
        <div class="row">
        <div
        class="col-md-4 col-sm-6 col-lg-4">
        <div class="mb-3 text-dark">
        <label
        for="exampleFormControlInput1"
        class="form-label  tex-dark">Passenger
        Name</label>
        <input type="text"
        class="form-control"
        id="exampleFormControlInput1">

        </div>
        </div>
        <div
        class="col-md-4 col-sm-6 col-lg-4">
        <div class="mb-3 text-dark">
        <label
        for="exampleFormControlInput1"
        class="form-label  tex-dark">Phone
        Number</label>
        <input type="text"
        class="form-control"
        id="exampleFormControlInput1">

        </div>
        </div>
        <div
        class="col-md-4 col-sm-6 col-lg-4">
        <div class="mb-3 text-dark">
        <label
        for="exampleFormControlInput1"
        class="form-label  tex-dark">Address</label>
        <input type="textarea"
        class="form-control"
        id="exampleFormControlInput1">

        </div>
        </div>
        </div>
        <div class="row">
        <div
        class="col-md-4 col-sm-6 col-lg-4">
        <div class="mb-3 text-dark">
        Events
        <select class="form-select"
        aria-label="Default select example">
        <option selected>Event
        </option>
        <option value="1">
        One</option>
        <option value="2">
        Two</option>
        <option value="3">
        Three</option>
        </select>
        </div>
        </div>
        <div
        class="col-md-4 col-sm-6 col-lg-4">
        <div class="mb-3 text-dark">
        Trips
        <select class="form-select"
        aria-label="Default select example">
        <option selected>Open
        this select menu
        </option>
        <option value="1">
        One</option>
        <option value="2">
        Two</option>
        <option value="3">
        Three</option>
        </select>
        </div>
        </div>
        <div
        class="col-md-4 col-sm-6 col-lg-4">
        <div class="mb-3 text-dark">
        Stoppages
        <select class="form-select"
        aria-label="Default select example">
        <option selected>Open
        this select menu
        </option>
        <option value="1">
        One</option>
        <option value="2">
        Two</option>
        <option value="3">
        Three</option>
        </select>
        </div>
        </div>

        </div>
        <div class="row">
        <div
        class="col-md-4 col-sm-6 col-lg-4">
        <div class="mb-3 text-dark">
        Number of Seats
        <input type="number" min="1"  max="10" class="form-control" id="exampleFormControlInput1">  
        </div>
        </div>
        <div
        class="col-md-4 col-sm-6 col-lg-4">

        </div>
        <div
        class="col-md-4 col-sm-6 col-lg-4">

        </div>
        </div>


        </div>
        </form>
        </div>
        <div class="modal-footer">
        {{-- <button type="button"
        class="btn btn-secondary"
        data-bs-dismiss="modal">Close</button> --}}
        <button type="button"
        class="btn btn-primary">Booking Conform</button>


        </div>
        </td>
        </tr>
        </tbody>
        </table>
        </div>
        </div>
        </div>
        </div>
        </td>

        </tr>

        </tbody>
        </table>
        </div>

        <script>
      
        
        </script>

        </x-frontend.layouts.master>


