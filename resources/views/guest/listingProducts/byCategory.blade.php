@extends('layouts.app')
@section('pageTitle', "Kategorija ". $categoryName)


@section('content')

<div class="col-12">

<h1 class="c1 text-center mb-4">Kategorija {{$categoryName}}</h1>


  <listing-products-and-product-groups :products="{{$products}}" :product-groups="{{$productGroups}}"></listing-products-and-product-groups>


</div>









@endsection

<style>
#app{
  background-color: rgba(#ffffff, 0) !important;
  background-image: linear-gradient(to right, #af92c4, #fff);
}
</style>
