@extends('layouts.app')
@section('pageTitle', "Grupa proizvoda ". $groupName)


@section('content')

<div class="@if($secondAd) col-12 col-md-9 @else col-12 @endif">

<h1 class="c1 text-center mb-4">Grupa proizvoda {{$groupName}}</h1>


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
