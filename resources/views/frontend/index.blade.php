<x-frontend.layouts.master>
    @if (Session::has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert">
            <i class="fa fa-times"></i>
        </button>
        <strong>Success !</strong> {{ session('success') }}
    </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">
                <i class="fa fa-times"></i>
            </button>
            <strong>Error !</strong> {{ session('error') }}
        </div>
    @endif
    <div style="text-align: center; padding-top:60px; padding-bottom:70px;">
        <img src="{{ asset('ui/frontend/images/Phantom_Tranzit.jpg')}}" alt="" heigt=400px; width=400px; class="logo-image">
    </div>
</x-frontend.layouts.master>