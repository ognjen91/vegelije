@extends('layouts.app')
@section('pageTitle', 'Homepage')

@section('content')

@if($mainAds->count())
<market-main-top :main-ad='{{$mainAds[rand(0, $mainAds->count()-1)]}}'></market-main-top>
@endif
<no-product-danger></no-product-danger>



<div class="col-12 w-100 mb-2 mb-md-3 mb-lg-4 mt-3 mt-sm-2 mt-lg-0 titleWrap d-flex flex-column">
  <h1 class="text-center w-100 c2 spaced appTitle">Vege Li Je <span class='c1' id="qmark"><strong>?</strong></span></h1>
  <h5 class="text-center w-100 c2 spaced2"><small>provera vege i ostalih proizvoda</small></h5>
</div>

{{-- ---------BARS+SEARCH BTN --}}
<div class="col-12 mb-md-2 rounded-bottom" id='bars'>
@include('guest.homepage.bars')
</div>

{{-- ---------/BARS+SEARCH BTN --}}

<div class="row">

{{-- RANDOM TAGOVI --}}
<div class="col-12 col-md-3 px-3 mt-3  px-md-3 mt-md-0 pt-md-2 col-lg-2 px-lg-1 randomTags" id="randomTags">
 @include('guest.homepage.randomTags')
</div>
{{-- //RANDOM TAGOVI --}}


{{-- POCETNI PRIKAZ PROIZVODA --}}
<div class="initial col-12 col-md-9 col-lg-9 pt-2 initialResults" id="initialResults">
      @include('guest.homepage.initialProducts')
</div>
{{-- //POCETNI PRIKAZ PROIZVODA --}}


{{-- REZULTATI PRETRAGE --}}
<div class="col-12 col-md-9 col-lg-9 pt-2" id="results">
      <search-results></search-results>
</div>
{{-- //REZULTATI PRETRAGE --}}
</div>


<div class="col-12 col-md-9 col-lg-9 bottom d-flex justify-content-center mb-2 mb-md-4">
  @include('includes.ads.MainAdDown')
</div>


</div>
@endsection

{{-- factory('App\Product', 300)->create()->each(function($u){$u->legalities()->sync([1,2]);); --}}
<style>

  #app{
    background-color: rgba(#ffffff, 0) !important;
    background-image: linear-gradient(to right, #b29ec2, #fff);
  }

</style>
