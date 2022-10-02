<x-frontend.layouts.master>

    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
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

    </div>
</x-frontend.layouts.master>