{{-- <nav class="navbar navbar-expand-lg navbar-light" style="background: #400859;">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="#!"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <img src="{{ asset('ui/frontend/images/logo_small.png')}}" alt="" class="img-circule" >

<a class="nav-link text-white " href="/"><strong>Phantom Tranzit</strong></a>

<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
  <li class="nav-item">
    <a class="nav-link text-white" href="#" style="font-size: 20px;   padding-right: 20px;"><strong>Fleet</strong></a>
  </li>
  <li>
    <a class="nav-link text-white pr-5" href="/contactUs" style="font-size: 20px; padding-right: 20px;"><strong>Contact Us</strong></a>
  </li>
  <li>
    <a class="btn btn-bg text-secindary rounded-pill mr-2" href="#" style="background: #ffffff; font-size: 20px; padding-right: 20px;">
      <strong>Get a Quote</strong> </a>
  </li>
</ul>
</div>
</div>
</nav> --}}



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
            <li>
                <a href="{{ route('passenger_login') }}" class="active1"><strong>Login</strong></a>
            </li>
            {{-- <li>
                <a href="#" class="active"><strong>Get a Quote</strong></a>
            </li> --}}
            {{-- @if (Route::has('login'))
                @auth
                    <li>
                        <a href="{{ route('home') }}"><strong>Dashboard</strong></a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('login') }} " class="active1"><strong>Log In</strong></a>
                    </li>
                   @if (Route::has('register'))
                        <li>
                            <a href="{{ route('register') }}" class="active2"><strong>Register</strong></a>
                        </li>
                    @endif
                @endauth
            @endif --}}
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
