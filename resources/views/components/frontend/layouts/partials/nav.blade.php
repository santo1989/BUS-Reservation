
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

    </nav>
</header>

<script>
    tranzit = document.querySelector(".tranzit");
    tranzit.onclick = function() {
        navBar = document.querySelector(".bla-bar");
        navBar.classList.toggle("active");
    }
</script>
