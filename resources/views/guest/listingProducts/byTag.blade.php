@extends('layouts.app')
@section('pageTitle', "Oznaka ". $tagName . ": proizvodi")


@section('content')

<div class="@if($secondAd && ($products->count() || $productGroups->count())) col-12 col-md-9 @else col-12 @endif">

<h1 class="c1 text-center mb-5 underlined">Oznaka "{{$tagName}}"</h1>
<tag-input></tag-input>


  <listing-products-and-product-groups :products="{{$products}}" :product-groups="{{$productGroups}}"></listing-products-and-product-groups>


</div>



@if($secondAd && ($products->count() || $productGroups->count()))
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
