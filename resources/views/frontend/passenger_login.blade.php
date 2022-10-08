<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Passanger Login</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />

  <link rel="stylesheet" href="{{ asset('css/passangerLogin.css') }}">
</head>


<body>
 <div class="wrapper">
        <div class="logo">
            <img src="{{ asset('ui/frontend/images/Phantom_Tranzit.jpg')}}" alt="" ; class="logo-image">
        </div>
        <div class="text-center mt-4 name">
            Phantom Tranzit
        </div>
        <form class="p-3 mt-3" action="{{ route('passenger_login_post') }}" method="POST">
            @csrf
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="email" name="email" id="userName" placeholder="Email">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="pwd" placeholder="Password">
            </div>
            <input type="hidden" name="routeName" value="{{ $route['routeName'] }}">
            <input type="hidden" name="parameter" value="{{ $route['parameter'] }}">

            <button type="submit" class="btn mt-3">Login</button>
        </form>
        <div class="text-center fs-6">
            <a href="#">Sign up</a>
        </div>
    </div>
</body>
</html>