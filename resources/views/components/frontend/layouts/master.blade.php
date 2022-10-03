<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Phantom Tranzit</title>
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('ui/frontend/css/styles.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('ui/frontend/css/customstyle.css') }}">
        @stack('css')
    </head>
    <body>
        <!-- Navigation-->
        {{-- @include('frontend.layouts.partials.nav') --}}
        <x-frontend.layouts.partials.nav />
       
        <!-- Section-->
        <section>
            <div class="container">
                {{ $slot }}
            </div>
        </section>
        <!-- Footer-->
        <x-frontend.layouts.partials.footer/>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('ui/frontend/js/scripts.js') }}"></script>
        @stack('js')
        
    </body>
</html>