<footer class="row pt-5 pt-lg-4 @if(Route::currentRouteName() == 'checkProduct') @if(!$product->isRecommended) checkProductFooter @else checkRecommendedFooter @endif @endif">
<div class="col-12 mb-4 attention">
<p class='text-center c5'><small>*Svi podaci na sajtu su informativnog karaktera i služe isključivo boljem informisanju potrošača. <br>
Ne možemo garantovati za tačnost podataka, ali imamo najbolju nameru.</small></p>
</div>


  <div class="col-12 mb-1 categories">
    <div class="row px-3">
    @guest
      @foreach ($categories as $category)
        <a href="/kategorija/{{$category->name}}" class="footerCat col-4 text-center mb-2 mb-lg-3"><strong>{{$category->name}}</strong></a>
      @endforeach
    @else

      <a href="{{route('home')}}" class="footerCat col-4 text-center mb-2"><strong>Dash</strong></a>
      <a href="{{route('products')}}" class="footerCat col-4 text-center mb-2"><strong>Proizvodi</strong></a>
      <a href="{{route('productGroups')}}" class="footerCat col-4 text-center mb-2"><strong>Grupe</strong></a>
      <a href="{{route('suggestions')}}" class="footerCat col-4 text-center mb-2"><strong>Predlozi</strong></a>
      <a href="{{route('manufacturers')}}" class="footerCat col-4 text-center mb-2"><strong>Proizvođači</strong></a>
      <a href="{{route('logout')}}" class="footerCat col-4 text-center mb-2"><strong>Log Out</strong></a>

    @endguest
    </div>
    <div class="row mt-3 mb-1">
      <p class="text-center w-100 text-light">Vegelije &copy; 2019
        <a href="{{config('app.fb')}}" class="c1Link mx-1 mx-md-2"><i class="fab fa-facebook-square text-light"></i></a>
        <a href="{{config('app.insta')}}" class="c1Link mx-1 mx-md-2"><i class="fab fa-instagram text-light"></i></a>
        <br>
      <span class="spaced2">
        Aplikaciju razvio <a class='underlined' href="{{config('app.ognjen_site')}}">Ognjen</a>
      <span>
      </p>
    </div>
  </div>

</footer>
