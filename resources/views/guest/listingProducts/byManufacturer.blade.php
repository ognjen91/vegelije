@extends('layouts.app')

@section('pageTitle', "Proizvođač ". $manufacturer->name . ": proizvodi")
@section('pageDescription')
Proizvođač {{$manufacturer->name}} : vege provera i izlistavnje proizvoda i grupa proizvoda povezanih sa ovim proizvođačem.
U bazi imamo {{$products->count()}} {{$products->count() ==1? 'proizvod' : 'proizvoda'}} ovog proizođača. Pogledajte!
@endsection
@section('keywords') proizvođač {{$manufacturer->name}} proizvodi @foreach ($products as $product) {{$product->name}}  @endforeach  @endsection
  @section('socialUrl', '/proizvodjac/{{$manufacturer->id}}')
  @section('socialTitle', 'Vegelije: vege provera proizvoda proizvođača '.$manufacturer->name."?")
  @section('socialImage', $manufacturer->image !== 'placeholder.png'? $manufacturer->image : '/assets/vegelije.jpg')
  @section('socialDescription', "Vegelije: provera da li je su proizvodi proizvođača ". $manufacturer->image . " veganski i vegetarijanski")

  @section('ogType', 'article')



@section('content')

<main class="@if($secondAd) col-12 col-md-9 @else col-12 @endif">

<h1 class="c1 text-center mb-4">Proizvođač <strong>{{$manufacturer->name}}</strong></h1>

<section class="row">
  @if($manufacturer->image !== 'placeholder.png')
  <div class="manufImage col-8 offset-2 @if($manufacturer->description) col-md-4 offset-md-0 col-lg-3 offset-lg-1 @else col-md-6 offset-md-3 @endif">
    <img src="/images/{{$manufacturer->image}}" alt="slika proizvođača">
  </div>
  @endif
  @if($manufacturer->description)
  <div class="col-10 offset-1   @if($manufacturer->image !== 'placeholder.png') col-md-8 offset-md-0 col-lg-7 @else col-md-8 offset-md-2 @endif">
    {!!  $manufacturer->description !!}
  </div>
  @endif
</section>


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
