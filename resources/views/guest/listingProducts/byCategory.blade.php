@extends('layouts.app')
@section('pageTitle', "Kategorija ". $categoryName)
@section('pageDescription')
Kategorija {{$categoryName}} : vege provera i izlistavnje proizvoda. U bazi imamo {{$products->count()}} {{$products->count() ==1? 'proizvod' : 'proizvoda'}} i
{{$productGroups->count()}} grupa proizvoda povezanih sa ovom grupom proizvoda. Uverite se!
@endsection
@section('keywords') {{$categoryName}} ketegorija  proizvodi grupe proizvoda  @endsection
  @section('socialUrl', '/kategorija/{{$categoryName}')
  @section('socialTitle', 'Vegelije: kategorija {{$categoryName}}')
  @section('socialDescription', "Vegelije: provera da li je su proizvodi u kategoriji ". $categoryName . " veganski i vegetarijanski")






@section('content')

<main class="@if($secondAd) col-12 col-md-9 @else col-12 @endif">

<h2 class="c1 text-center mb-4 underlined"><span class="fo2 h1">Vegelije</span>: kategorija <span class="text-lowercase">{{$categoryName}}</span></h2>


  <listing-products-and-product-groups :products="{{$products}}" :product-groups="{{$productGroups}}"></listing-products-and-product-groups>


</main>


@if($secondAd && ($products->count() || $productGroups->count()))
<aside class="col-12 col-md-3 second">
@include('includes.ads.SecondAd')
</aside>
@endif






@endsection

<style>
#app{
  background-color: rgba(#ffffff, 0) !important;
  background-image: linear-gradient(to right, #af92c4, #fff);
}
</style>
