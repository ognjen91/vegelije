@extends('layouts.app')
@section('pageTitle', "Top liste")


@section('content')

<div class="col-12">

<h2 class="c2 text-center mb-4"><span class="c1"><strong>Vegelije</strong></span> Top 10 <br> <small>najčešće pregledani proizvodi i grupe</small></h2>


  <listing-top-products-and-product-groups :products="{{$products}}" :product-groups="{{$productGroups}}"></listing-top-products-and-product-groups>


</div>









@endsection

<style>
#app{
  background-color: rgba(#ffffff, 0) !important;
  background-image: linear-gradient(to right, #d3d589, #fff);
  /* background-image: linear-gradient(to right, #b1d589, #fff); */
}
</style>
