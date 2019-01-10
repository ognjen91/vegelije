@extends('layouts.app')
@section('pageTitle', "Grupa proizvoda ". $groupName)
@section('pageDescription')
Informacije o grupi proizvoda {{$groupName}} i izlistavanje vege proizvoda koji pripadaju, ili su povezani sa ovom grupom.
Ova grupa proizvoda je spojena sa {{$products->count()}} proizvoda, između ostalih i sa proizvodima: @foreach ($products as $key=>$product) @if($key<=15) {{$product->name}} @endif @endforeach) - dođite i proverite.
Dobrodošli na Vegelije!
@endsection
@section('keywords') {{$product->name}} provera grupe vegan vegansko vegetarijansko cruelty-free gluten-free  @endsection
  @section('socialTitle', 'Vegelije: grupa proizvoda {{$groupName}}')
  @section('socialDescription', "Vegelije: provera da li je su proizvodi u grupi ". $groupName . " veganski i vegetarijanski")


@section('content')

<main class="@if($secondAd) col-12 col-md-9 @else col-12 @endif">

<h1 class="c1 text-center mb-4">Grupa proizvoda {{$groupName}}</h1>


  <listing-products-and-product-groups :products="{{$products}}"></listing-products-and-product-groups>


</main>

@if($secondAd && $products->count())
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
