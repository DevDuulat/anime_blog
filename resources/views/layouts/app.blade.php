<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Default Title')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet" />

  <!-- Css Styles -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/plyr.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css" />
</head>

<body>
  <div id="preloder">
    <div class="loader"></div>
  </div>

  @include('partials.header')

  @yield('content')

  @include('partials.footer')

  <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/player.js') }}"></script>
  <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
  <script src="{{ asset('js/mixitup.min.js') }}"></script>
  <script src="{{ asset('js/jquery.slicknav.js') }}"></script>
  <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>