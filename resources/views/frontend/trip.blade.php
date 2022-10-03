<x-frontend.layouts.master>

    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

        <p class="text-center" style="padding-top:10px; padding-bottom:20px; font-family:Verdana, Geneva, Tahoma, sans-serif">Take a Trip</p>
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
                            <a class="btn btn-outline-light" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Somudro Bilash</a>
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
                                                    <td><button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target=".bd-example-modal-lg" >Show Bookings</button></td>

                                                    <!-- Modal -->
                                                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
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
        var myModal = document.getElementById('exampleModal')
        var myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', function() {
            myInput.focus()
        })
    </script>

</x-frontend.layouts.master>