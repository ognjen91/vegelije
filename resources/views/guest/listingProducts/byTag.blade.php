@extends('layouts.app')
@section('pageTitle', "Oznaka ". $tagName . ": proizvodi")


@section('content')

<div class="col-12">

<h1 class="c1 text-center mb-5">Oznaka {{$tagName}}</h1>
<tag-input></tag-input>


  <listing-products-and-product-groups :products="{{$products}}" :product-groups="{{$productGroups}}"></listing-products-and-product-groups>




</div>









@endsection

<style>
#app{
  background-color: rgba(#ffffff, 0) !important;
  background-image: linear-gradient(to right, #af92c4, #fff);
}
</style>
