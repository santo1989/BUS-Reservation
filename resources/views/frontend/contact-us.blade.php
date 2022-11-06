<x-frontend.layouts.master>
    <x-backend.layouts.elements.message :fmessage="session('message')" />
    {{-- <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        <h1 >Contact Us</h1>

    </div>
    <div style="border:5px solid;  border-radius: 25px; border-color: #400859; margin-left:200px; margin-right:200px;">
        <div class=" d-flex justify-content-between" style="margin-left:45px; margin-right:45px; margin-top: 20px;">
            <label for="name" class=""> <strong>Your Name:</strong> </label>
            <input type="text" class="" id="name" size="65">
        </div>
        <div class=" d-flex justify-content-between" style="margin-left:45px; margin-right:45px; margin-top: 20px;">
            <label for="email" class=""> <strong>Email Address:</strong> </label>
            <input type="text" class="" id="email" size="65">
        </div>
        <div class=" d-flex justify-content-between" style="margin-left:45px; margin-right:45px; margin-top: 20px; margin-bottom:40px;">
            <label for="message" class=""><strong>Message:</strong></label>
            <textarea rows="4" cols="67"></textarea>
        </div>
        <div class="d-flex justify-content-end"  style="margin-left:45px; margin-right:45px; margin-top: 20px; margin-bottom:40px;">
        <button class="">Submit</button>
        </div>

    </div> --}}


    <div class="content">


        <div class="container">
            <div class="row align-items-stretch no-gutters contact-wrap">
                <div class="col-md-12">
                    <div class="form h-100">
                        <h3>Get Started</h3>
                        <form class="mb-5" method="post" id="contactForm" name="contactForm"
                            action="{{ route('contract_message.store') }}">
                            @csrf
                            <div class="row">
                                @if (Session::has('user'))
                                    @php
                                        $user = Session::get('user');
                                    @endphp

                                    {{-- @dd($user); --}}

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="" class="col-form-label">Name *</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Your name" value="{{ $user->name }}" required readonly>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="" class="col-form-label">Email *</label>
                                        <input type="text" class="form-control" name="email" id="email"
                                            placeholder="Your email" value="{{ $user->email }}" required readonly>
                                    </div>
                            </div>



                            <div class="row">
                                <div class="col-md-12 form-group mb-3">
                                    <label for="message" class="col-form-label">Message *</label>
                                    <textarea class="form-control" name="message" id="message" cols="30" rows="4"
                                        placeholder="Write your message" required></textarea>
                                </div>
                            </div>
                        @else
                            <div class="col-md-6 form-group mb-3">
                                <label for="" class="col-form-label">Name *</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Your name" required>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="" class="col-form-label">Email *</label>
                                <input type="text" class="form-control" name="email" id="email"
                                    placeholder="Your email" required>
                            </div>
                    </div>



                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                            <label for="message" class="col-form-label">Message *</label>
                            <textarea class="form-control" name="message" id="message" cols="30" rows="4"
                                placeholder="Write your message" required></textarea>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <input type="submit" value="Send Message" class="btn btn-primary rounded-0 py-2 px-4"
                                id="submitfrom">
                            <span class="submitting"></span>
                        </div>
                    </div>
                    </form>

                    <div id="form-message-warning mt-4">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // fetch('{{ route('contract_message.store') }}', {
        //   method: 'POST',
        //   headers: {
        //     'Content-Type': 'application/json',
        //     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        //   },
        //   body: JSON.stringify({
        //     name: document.querySelector('#name').value,
        //     email: document.querySelector('#email').value,
        //     message: document.querySelector('#message').value,
        //   })
        // })
        // .then(response => response.json())
        // .then(data => {
        //   swal.fire({
        //     title: 'Success!',
        //     text: data.message,
        //     icon: 'success',
        //     confirmButtonText: 'OK'
        //   })
        // })
        // .catch(error => {
        //   swal.fire({
        //     title: 'Error!',
        //     text: error.message,
        //     icon: 'error',
        //     confirmButtonText: 'OK'
        //   })
        // });




        // let submitfrom = document.getElementById('submitfrom');
        // submitfrom.addEventListener('click', function(){
        //     swal.fire({
        //         title: 'Message Sent!',
        //         text: 'Thank you for contacting us. We will get back to you soon.',
        //         icon: 'success',
        //         confirmButtonText: 'Ok'
        //         time : 5000;
        //     })
        // })
    </script>
    </div>

    @push('css')
        <style>
            body {
                font-family: "Roboto", sans-serif;
                background-color: #fff;
                line-height: 1.9;
                color: #8c8c8c;
                position: relative;
            }

            h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            .h1,
            .h2,
            .h3,
            .h4,
            .h5,
            .h6 {
                font-family: "Roboto", sans-serif;
                color: #000;
            }

            a {
                -webkit-transition: .3s all ease;
                -o-transition: .3s all ease;
                transition: .3s all ease;
            }

            a,
            a:hover {
                text-decoration: none !important;
            }

            .text-black {
                color: #000;
            }

            .content {
                padding: 7rem 0;
            }

            .heading {
                font-size: 2.5rem;
                font-weight: 900;
            }

            .form-control {
                border: none;
                border-bottom: 1px solid #ccc;
                padding-left: 0;
                padding-right: 0;
                border-radius: 0;
                background: none;
            }

            .form-control:active,
            .form-control:focus {
                outline: none;
                -webkit-box-shadow: none;
                box-shadow: none;
                border-color: #000;
            }

            .col-form-label {
                color: #000;
                font-size: 13px;
            }

            .btn,
            .form-control,
            .custom-select {
                height: 45px;
                border-radius: 0;
            }

            .custom-select {
                border: none;
                border-bottom: 1px solid #ccc;
                padding-left: 0;
                padding-right: 0;
                border-radius: 0;
            }

            .custom-select:active,
            .custom-select:focus {
                outline: none;
                -webkit-box-shadow: none;
                box-shadow: none;
                border-color: #000;
            }

            .btn {
                border: none;
                border-radius: 0;
                font-size: 11px;
                letter-spacing: .2rem;
                text-transform: uppercase;
                border-radius: 30px !important;
            }

            .btn.btn-primary {
                border-radius: 30px;
                background: #ef4339;
                color: #fff;
                -webkit-box-shadow: 0 15px 30px 0 rgba(239, 67, 57, 0.2);
                box-shadow: 0 15px 30px 0 rgba(239, 67, 57, 0.2);
            }

            .btn:hover {
                color: #fff;
            }

            .btn:active,
            .btn:focus {
                outline: none;
                -webkit-box-shadow: none;
                box-shadow: none;
            }

            .contact-wrap {
                -webkit-box-shadow: 0 0px 20px 0 rgba(0, 0, 0, 0.05);
                box-shadow: 0 0px 20px 0 rgba(0, 0, 0, 0.05);
                border: 1px solid #efefef;
            }

            .contact-wrap .col-form-label {
                font-size: 14px;
                color: #b3b3b3;
                margin: 0 0 10px 0;
                display: inline-block;
                padding: 0;
            }

            .contact-wrap .form,
            .contact-wrap .contact-info {
                padding: 40px;
            }

            .contact-wrap .contact-info {
                color: rgba(255, 255, 255, 0.5);
            }

            .contact-wrap .contact-info ul li {
                margin-bottom: 15px;
                color: rgba(255, 255, 255, 0.5);
            }

            .contact-wrap .contact-info ul li .wrap-icon {
                font-size: 20px;
                color: #fff;
                margin-top: 5px;
            }

            .contact-wrap .form {
                background: #fff;
            }

            .contact-wrap .form h3 {
                color: #000;
                font-size: 2rem;
                font-weight: 700;
                margin-bottom: 30px;
            }

            .contact-wrap .contact-info {
                height: 100vh;
                background-size: cover;
                background-position: center center;
                background-repeat: no-repeat;
            }

            .contact-wrap .contact-info a {
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
            }

            @media (max-width: 1199.98px) {
                .contact-wrap .contact-info {
                    height: 400px !important;
                }
            }

            .contact-wrap .contact-info h3 {
                color: #fff;
                font-size: 20px;
                margin-bottom: 30px;
            }

            label.error {
                font-size: 12px;
                color: red;
            }

            #message {
                resize: vertical;
            }

            #form-message-warning,
            #form-message-success {
                display: none;
            }

            #form-message-warning {
                color: #B90B0B;
            }

            #form-message-success {
                color: #55A44E;
                font-size: 18px;
                font-weight: bold;
            }

            .submitting {
                float: left;
                width: 100%;
                padding: 10px 0;
                display: none;
                font-weight: bold;
                font-size: 12px;
                color: #000;
            }
        </style>
    @endpush

</x-frontend.layouts.master>
