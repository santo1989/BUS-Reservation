<x-frontend.layouts.master>

    <div class="container-gallery">

        <div class="desc">
            <div class="tittle">
                <h1 class="judul">See All the Transports</h1>
                <p class="text"><strong>Schedule</strong><br>
                    Daytime rates end at 6pm <br>
                    5 hour minimum anytime<br>
                    This bus is not available for 2 hour wedding transport<br>
                    If your daytime event extends into peak hour rates, you will be charged peak rates for the entire trip.</p>
            </div>

            <div class="imgsrc">
                <img src="{{ asset('ui/frontend/images/b2_select.jpg')}}" class="prev" height=50px; width=50px;>
            </div>
        </div>

        <div class="thumbnail">
            <img src="{{ asset('ui/frontend/images/bus_frontroom_small.png')}}" class="thumb">

            <img src="{{ asset('ui/frontend/images/b3_select.png')}}" class="thumb">

            <img src="{{ asset('ui/frontend/images/b2-2s.png')}}" class="thumb " height=100px; width=100px;
            <img src="{{ asset('ui/frontend/images/b2fronttpback_sm.jpg')}}" class="thumb">

           
            <img src="{{ asset('ui/frontend/images/b2fronttpback_sm.jpg')}}" class="thumb">

           
            <img src="{{ asset('ui/frontend/images/b2fronttpback_sm.jpg')}}" class="thumb">

           
        </div>
    </div>



    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            text-align: center;
            background-color: beige;
            font-family: "Poppins", sans-serif;
        }

        .container-gallery {
            margin: 3em auto;
            width: 610px;
            border: solid white 5px;
            border-radius: 30px;
            box-shadow: 5px 5px 25px rgba(0, 0, 0, 0.5);
            overflow: hidden;
        }

        .container-gallery .thumbnail {
            display: flex;
            flex-wrap: wrap;
        }

        .container-gallery .thumbnail .thumb {
            height: 200px;
            width: 200px;
            transition: all 0.2s;
            object-fit: cover;
            cursor: pointer;
        }

        .container-gallery .thumbnail .thumb:hover {
            box-shadow: 3px 3px 20px;
            opacity: 0.8;
        }

        .desc {
            position: relative;
            width: 600px;
            height: 400px;
            overflow: hidden;
        }

        .desc:hover .judul {
            transform: translateY(80px);
        }

        .desc:hover .tittle {
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.3) 30%, rgba(0, 0, 0, 0.3) 70%, rgba(0, 0, 0, 0.8) 100%);
            opacity: 1;
        }

        .desc:hover .text {
            transform: translateY(-150px);
        }

        .desc .prev {
            object-fit: cover;
            width: 600px;
            height: 400px;
        }

        .desc .tittle {
            margin: auto;
            overflow: hidden;
            width: 100%;
            height: 100%;
            position: absolute;
            transition: all 0.3s ease;
            opacity: 0;
            display: flex;
            flex-direction: column;
        }

        .desc .tittle .judul {
            color: white;
            padding: 20px;
            margin-top: -40px;
            transition: all 0.3s ease;
        }

        .desc .tittle .text {
            color: white;
            margin-top: 350px;
            padding: 20px;
            transition: all 0.35s ease 0.4s;
        }

        @keyframes fade {
            to {
                opacity: 1;
            }
        }

        .effect {
            opacity: 0;
            animation: fade 0.2s forwards;
        }

        .active {
            opacity: 0.5;
        }
    </style>

</x-frontend.layouts.master>