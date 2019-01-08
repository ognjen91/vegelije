@extends('layouts.app')
@section('pageTitle', "Kategorija ". $categoryName)


@section('content')

<div class="@if($secondAd) col-12 col-md-9 @else col-12 @endif">

<h2 class="c1 text-center mb-4 underlined"><span class="fo2 h1">Vegelije</span>: kategorija <span class="text-lowercase">{{$categoryName}}</span></h2>


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
