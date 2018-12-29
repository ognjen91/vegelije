<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('pageTitle') | {{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="/images/pig.png" />

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Maven+Pro" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app" class="container-fluid">

        @include('includes.header')



        @include('includes.errors')
        @include('includes.success')

        {{-- ({{dd(Route::currentRouteName())}}) --}}
        <div class="row content pb-5 @if(Route::currentRouteName() == 'checkProduct') checkProduct @endif">
            @auth
              <div class="col-12 py-2">
                <h3 class='fo1 text-align-center spaced font-weight-bold'>@yield('adminTitle')</h3>
              </div>
            @endauth

            @yield('content')
        </div>


      @include('includes.footer')

    </div>
</body>

</html>
