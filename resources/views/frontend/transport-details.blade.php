<x-frontend.layouts.master>
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

            >* {
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
            /* font-family: 'Inconsolata', monospace; */
            text-align: center;
            font-size: 15px;
            letter-spacing: 1px;
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

        @media (max-width: 800px) {
            body-image {
                transform: scale(0.6);
            }
        }

        @media (max-width: 600px) {
            .wrapper {
                display: block;

                >* {
                    margin: 10px;
                }
            }
        }
    </style>

<div class="body-image" style ="padding-bottom:20px;">

<div class="wrapper">
<div class="media">
<div class="layer">
    <p>+ Paul Gilmore</p>
  </div>
<img src="https://images.unsplash.com/photo-1431818563807-927945852ab6?dpr=1&auto=format&fit=crop&w=1199&h=899&q=80&cs=tinysrgb&crop=" alt="" />
</div>
<div class="media">
<div class="layer">
    <p>+ Paul Gilmore</p>
  </div>
<img src="https://images.unsplash.com/photo-1431818563807-927945852ab6?dpr=1&auto=format&fit=crop&w=1199&h=899&q=80&cs=tinysrgb&crop=" alt="" />
</div>
<div class="media">
<div class="layer">
    <p>+ Paul Gilmore</p>
  </div>
<img src="https://images.unsplash.com/photo-1431818563807-927945852ab6?dpr=1&auto=format&fit=crop&w=1199&h=899&q=80&cs=tinysrgb&crop=" alt="" />
</div>
 <div class="media">
<div class="layer">
    <p>+ M. O' Neil</p>
  </div>
<img src="https://images.unsplash.com/photo-1443397646383-16272048780e?dpr=1&auto=format&fit=crop&w=1199&h=899&q=80&cs=tinysrgb&crop=" alt="" />
</div>
   <div class="media">
<div class="layer">
    <p>+ N. Mehta</p>
  </div>
<img src="https://images.unsplash.com/photo-1442965416224-f6a7eca980fa?dpr=1&auto=format&fit=crop&w=1199&h=799&q=80&cs=tinysrgb&crop=" alt="" />
</div>
</div>
</div>

<div style="border: 2px solid blue; padding-top:20px;">
    <p style="font-size:25px;">Audio</p>
    <ul class="text-center">
        <li>
        Individual Seating for 35 passengers
        </li>
        <li>
        Seat Belts
        </li>
        <li>
        Reclining Seats
        </li>
        <li>
        Foot Rests
        </li>
        <li>
        Small baggage rack
        </li>
        <li>
        Cup Holders
        </li>
        <li>
        Map Lights
        </li>
        <li>
        4 tables
        </li>
    </ul>
   
    <p style="font-size:25px;">Features</p>
    <ul>
        <li></li>
    </ul>
</div>

</x-frontend.layouts.master>