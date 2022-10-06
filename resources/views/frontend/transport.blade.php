<x-frontend.layouts.master>

<div class="text-center" style="padding-right:400px; padding-left:400px;" ><p 
        style="padding-top:10px; padding-bottom:20px; font-family: 'Inconsolata', monospace;  font-size: 25px;
            letter-spacing: 1px; border: 2px solid black">BUSES</p>
            </div>
<div class="wrapper">
<div class="media">
<div class="layer">
<a href="{{ route('transport_details')}}"><p style="text-decoration:none; color:black;">BUS 1</p></a>
  </div>
<img src="{{ asset('ui/frontend/images/b2_select.jpg')}}" alt="" />
</div>
 <div class="media">
<div class="layer">
<a href="{{ route('transport_details2')}}"><p style="text-decoration:none; color:black;">BUS 2</p></a>
  </div>
<img src="{{ asset('ui/frontend/images/b3_select.jpg')}}" alt="" />
</div>
   
</div>

<style>
    @import url('https://fonts.googleapis.com/css?family=Inconsolata|Source+Sans+Pro:200,300,400,600');

body-image {
  height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  background: #E0E0E0;
  overflow: hidden;
}

h1 {
  font-family: 'Source Sans Pro', sans-serif;
  font-size: 22px;
  color: #151E3F;
  font-weight: 300;
  letter-spacing: 2px;
}

.wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  > * {
    margin: 5px;
  }
}

.media {
  width: 300px;
  height: 200px;
  overflow: hidden;
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  img {
      max-width: 100%;
      height: auto;
    }
}

.layer {
  opacity: 0;
  position: absolute;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 10px;
  height: 90%;
  background: #FFF;
  color: #151E3F;
  transition: all 0.9s ease;
  p {
    transition: all 0.9s ease;
    transform: scale(0.1)
  }
}

p {
  font-family: 'Inconsolata', monospace;
  text-align: center;
  font-size: 15px;
  letter-spacing:1px;
}

.media:hover .layer {
  opacity: 0.8;
  width: 90%;
  transition: all 0.5s ease;
  p {
    transform: scale(1);
    transition: all 0.9s ease;
  }
}

@media (max-width: 800px){
  body-image {
    transform: scale(0.6);
  }
}

@media (max-width: 600px) {
    .wrapper {
    display: block;
    > * {
      margin: 10px;
    }
  }
}
</style>

</x-frontend.layouts.master>