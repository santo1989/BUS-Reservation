
{{-- 2nd Navbar --}}

<header class="nav-header">
    <div class="navvv">

        <img src="{{ asset('ui/frontend/images/logo_small.png') }}" alt="" heigt=50px; width=60px;
            class="logo-image">

        <div class="logo"><a
                href="{{ route('Phantom-Tranzit') }} "class="text-white text-decoration-none"><strong>Phantom
                    Tranzit</strong></a></div>

    </div>
    <div class="tranzit">
        <div class="line"> </div>
        <div class="line"></div>
        <div class="line">

        </div>
    </div>

    <nav class="bla-bar">

        <ul>
            @if(Session::has('user'))
                <li style="list-style: none;">
                    <a class="form-check form-switch" style="text-decoration: none;" id="switch">
                        <label  for="flexSwitchCheckDefault">24 hr</label>
                        <input class="form-check-input" type="checkbox" id="time_format" {{ session('user')->time_format == 24 ? 'checked' : '' }}>
                    </a>
                </li>
            @endif
            <li>
                <a href="{{ route('transport') }}"><strong>Fleet</strong></a>
            </li>
            <li>
                <a href="{{ route('fleets') }}"><strong>Events</strong></a>
            </li>
            <li>
                <a href="{{ route('contactUS') }}"><strong>Contact Us</strong></a>
            </li>


            @if (Session::has('user'))
                <li>
                    <a href="{{ route('mybooking') }}"><strong>My Booking</strong></a>
                </li>
                <li>
                    <form method="POST" action="{{ route('passenger_logout') }}">
                        @csrf
                        <a class="dropdown-item"
                            onclick="event.preventDefault();
                                    this.closest('form').submit();"><strong>Logout</strong></a>

                    </form>
                </li>
            @else
                <li>
                    <a href="{{ route('passenger_login') }}"><strong>Login</strong></a>
                </li>
            @endif
        </ul>

        <input type="hidden" id="base_url" value="{{ url('') }}">
        @if (Session::has('user'))
            <input type="hidden" id="user_id" value="{{ session('user')->id }}">
        @endif

    </nav>
</header>

<script>
    tranzit = document.querySelector(".tranzit");
    tranzit.onclick = function() {
        navBar = document.querySelector(".bla-bar");
        navBar.classList.toggle("active");
    }

    $('#time_format').on('click', () => {
        const base_url = $("#base_url").val();
        const user_id = $("#user_id").val();
        if($("#time_format").is(':checked')){
           fetch(base_url+`/change-time-format/24`)
           .then(response => response.json())
           .then(data => {
               if(data == "done") {
                   window.location.reload();
               }
           })
        }
        else{
           fetch(base_url+`/change-time-format/12`)
           .then(response => response.json())
           .then(data => {
                if(data == "done") {
                    window.location.reload();
                }    
           })
        }
    })

</script>
