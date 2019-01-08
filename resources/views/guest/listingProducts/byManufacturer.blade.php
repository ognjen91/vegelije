@extends('layouts.app')

@section('pageTitle', "Proizvođač ". $manufacturer->name . ": proizvodi")

@section('content')

<div class="@if($secondAd) col-12 col-md-9 @else col-12 @endif">

<h1 class="c1 text-center mb-4">Proizvođač <strong>{{$manufacturer->name}}</strong></h1>

<div class="row">
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
</div>


  <listing-products-and-product-groups :products="{{$products}}"></listing-products-and-product-groups>


</div>



@if($secondAd && $products->count())
<div class="col-12 col-md-3 second">
@include('includes.ads.SecondAd')
</div>
@endif





@endsection

<style>
#app{
  background-color: rgba(#ffffff, 0) !important;
  background-image: linear-gradient(to right, #af92c4, #fff);
}
</style>
