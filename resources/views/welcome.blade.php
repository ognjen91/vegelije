@extends('layouts.app')
@section('pageTitle', 'Vegelije: vege pretraga i provera proizvoda')
@section('pageDescription')
Najsveobuhvatnije pretraga i provera veganskih i vegetarijanskih proizvoda na Balkanu. Pronađite proizvod za koji niste
sigurni da li je veganski ili vegetarijanski, pretražite proizvode po proizvođačima, kategorijama, oznakama, ali
i doprinesite sajtu i zajednici učestvujući u kreiranju novih saržaja i popravljanju starih.
@endsection
@section('keyword') vegan vegansko vegetarijansko cruelty-free gluten-free @foreach($randomTags as $tag) {{$tag}} @endforeach @endsection


@section('content')
{{-- {{dd(phpinfo())}} --}}
@if($mainAds->count())
<market-main-top :show-every='{{config("app.popup_show_every_h",1)}}' :main-ad='{{$mainAds[rand(0, $mainAds->count()-1)]}}'></market-main-top>
@endif
<no-product-danger></no-product-danger>



<div class="col-12 w-100 mb-2 mb-md-3 mb-lg-4 mt-3 mt-sm-2 mt-lg-0 titleWrap d-flex flex-column">
  <h1 class="text-center w-100 c2 spaced appTitle">Vege Li Je <span class='c1' id="qmark"><strong>?</strong></span></h1>
  <h5 class="text-center w-100 c2 spaced2"><small>vege pretraga i provera proizvoda</small></h5>
</div>

{{-- ---------BARS+SEARCH BTN --}}
<div class="col-12 mb-md-2 rounded-bottom" id='bars'>
@include('guest.homepage.bars')
</div>

{{-- ---------/BARS+SEARCH BTN --}}

<main class="row">

{{-- RANDOM TAGOVI --}}
<section class="col-12 col-md-3 px-3 mt-3  px-md-3 mt-md-0 pt-md-2 col-lg-2 px-lg-1 randomTags" id="randomTags">
 @include('guest.homepage.randomTags')
</section>
{{-- //RANDOM TAGOVI --}}


{{-- POCETNI PRIKAZ PROIZVODA --}}
<section class="initial col-12 col-md-9 col-lg-9 pt-2 initialResults" id="initialResults">
      @include('guest.homepage.initialProducts')
</section>
{{-- //POCETNI PRIKAZ PROIZVODA --}}


{{-- REZULTATI PRETRAGE --}}
<section class="col-12 col-md-9 col-lg-9 pt-2" id="results">
      <search-results></search-results>
</section>
{{-- //REZULTATI PRETRAGE --}}
</main>


<section class="col-12 col-md-9 col-lg-9 bottom d-flex justify-content-center mb-2 mb-md-4">
  @include('includes.ads.MainAdDown')
</section>


{{-- </div> --}}
@endsection

{{-- factory('App\Product', 300)->create()->each(function($u){$u->legalities()->sync([1,2]);); --}}
<style>

  #app{
    background-color: rgba(#ffffff, 0) !important;
    background-image: linear-gradient(to right, #b29ec2, #fff);
  }

</style>
