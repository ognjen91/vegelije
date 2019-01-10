<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('includes.analytics')
    <meta http-equiv=“Content-Type“ content=“text/html; charset=utf-8″ />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->

    <meta name="Description" content="@yield('pageDescription')" />
    <meta name="Keywords" content="@yield('keywords')" />
    <title>@yield('pageTitle') : {{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="/images/pig.png" />

    @include('includes.socialMeta')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Maven+Pro" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>

<body>
    <div id="app" class="container-fluid">

        @include('includes.header')



        @include('includes.errors')
        @include('includes.success')

        {{-- ({{dd(Route::currentRouteName())}}) --}}
        <div class="row content pb-5 @if(Route::currentRouteName() == 'checkProduct') @if(!$product->isRecommended) checkProduct @else checkRecommended @endif
        @elseif(Route::currentRouteName() == 'welcome') mb-2 mb-lg-3 @else {{Route::currentRouteName()}} @endif">

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
