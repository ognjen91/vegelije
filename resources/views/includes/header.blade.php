<nav class="navbar row  mb-lg-0 @if(Route::currentRouteName() == 'checkProduct') checkProductHeader @else mb-2 mb-sm-1 @endif">
  {{-- {{dd($user->notifications()->whereNotNull('read_at')->get())}} --}}

    {{-- LOGO --}}
    <a class="mt-1 col-3 col-md-2 col-lg-2 logo" href="{{route('homepage')}}"><img src="/images/pig.png" alt="logo"></a>
    {{-- HAMBURGER --}}
    <div class="mt-1 col-5 offset-2 mr-lg-4"><i class="fas fa-bars fa-3x c1 float-right" id='hamburger'></i></div>

    <div class="col-12 mainMenu" id='menu'>
        <i class="fas fa-times fa-3x closeMenu c4 py-1" id="closeMenu"></i>

        <ul class='text-center'>
          @guest
            <li class="menuItem"><a href="{{route('homepage')}}" class="fo1">Home</a></li>
            <li class="menuItem"><a href="{{route('guestListManufacturers')}}" class="fo1">Proizvođači</a></li>
            <li class="menuItem"><a href="{{route('guestListProductGroups')}}" class="fo1">Grupe proizvoda</a></li>
            <li class="menuItem"><a href="{{route('guestListCategories')}}" class="fo1">Kategorije</a></li>
            <li class="menuItem"><a href="{{route('listTags')}}" class="fo1">Oznake</a></li>
            <li class="menuItem"><a href="{{route('topLists')}}" class="fo1">Top liste</a></li>
            <li class="menuItem"><a href="{{route('suggestProduct')}}" class="fo1">Predložite</a></li>
            <li class="menuItem"><a href="{{route('aboutUs')}}" class="fo1">O VEGELIJAMA</a></li>
          @else
            <li class="menuItem"><a href="{{route('home')}}" class="fo1">Dashboard</a></li>
            <li class="menuItem"><a href="{{route('products')}}" class="fo1">Konkretni proizvodi</a></li>
            <li class="menuItem"><a href="{{route('productGroups')}}" class="fo1">Grupe proizvoda</a></li>
            <li class="menuItem"><a href="{{route('manufacturers')}}" class="fo1">Proizvođači</a></li>
            <li class="menuItem"><a href="{{route('suggestions')}}" class="fo1">Zahtevi</a></li>
            @admin
            <li class="menuItem"><a href="{{route('adminBussines')}}" class="fo1">Admin Business</a></li>
            @endadmin
            <li class="menuItem"><a href="{{route('logout')}}" class="fo1">Logout</a></li>
          @endguest
        </ul>


    </div>


</nav>


@auth
  @include('includes.adminHeader')
@endauth
