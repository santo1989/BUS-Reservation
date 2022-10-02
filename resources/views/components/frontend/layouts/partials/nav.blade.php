{{--<nav class="navbar navbar-expand-lg navbar-light" style="background: #400859;">
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
</nav>--}}

<header class="nav-header">
<img src="{{ asset('ui/frontend/images/logo_small.png')}}" alt="" heigt=80px; width=70px; class="logo-image" >
  <div class="logo">Phantom Tranzit</div>
  <div class="tranzit">
    <div class="line"> </div>
    <div class="line"></div>
    <div class="line"></div>
  </div>
  
  <nav class="bla-bar">
 
    <ul>
      <li>
        <a href="" >Fleet</a>
      </li>
      <li>
        <a href="">Contact Us</a>
      </li>
      <li>
        <a href="" class="active">Get a Quote</a>
      </li>
    </ul>
  </nav>
</header>

<script>
  tranzit = document.querySelector(".tranzit");
  tranzit.onclick = function()
  {
    navBar = document.querySelector(".bla-bar");
    navBar.classList.toggle("active");
  }
</script>