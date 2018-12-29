@extends('layouts.app')

@section('pageTitle', "Proizvođač ". $manufacturerName . ": proizvodi")

@section('content')

<div class="col-12">

<h1 class="c1 text-center mb-4">Proizvođač {{$manufacturerName}}</h1>


  <listing-products-and-product-groups :products="{{$products}}"></listing-products-and-product-groups>


</div>









@endsection

<style>
#app{
  background-color: rgba(#ffffff, 0) !important;
  background-image: linear-gradient(to right, #af92c4, #fff);
}
</style>
