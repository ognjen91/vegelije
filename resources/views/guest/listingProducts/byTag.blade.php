@extends('layouts.app')
@section('pageTitle', "Oznaka ". $tagName . ": proizvodi")
@section('pageDescription')
Vegelije : najsveobuhvatnije pretraga veganskih i vegetarijanskih proizvoda na Balkanu. Pretraga vege proizvoda po tagovima (oznakama): oznaka {{$tagName}}
@endsection
@section('keywords') oznaka {{$tagName}} vegan vegansko vegetarijansko cruelty-free gluten-free  @endsection
  @section('socialUrl', '/oznaka/{{$tagName}}')
  @section('socialTitle', 'Vegelije : oznaka '.$tagName)
  @section('ogType', 'article')
  @section('socialDescription', "Vegelije: provera da li je su proizvodi sa oznakom ". $tagName . " veganski i vegetarijanski")

@section('content')

<main class="@if($secondAd && ($products->count() || $productGroups->count())) col-12 col-md-9 @else col-12 @endif">

<h1 class="c1 text-center mb-5 underlined">Oznaka "{{$tagName}}"</h1>
<tag-input></tag-input>


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
