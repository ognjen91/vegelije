@extends('layouts.app')
@section('pageTitle', "Hall Of Fame")
@section('pageDescription')
Vegelije Top Lista: najčešće pregledani proizvodi i grupe proizvoda. Vi birate najbolje!
@endsection
@section('keywords')  vegan vegansko vegetarijansko cruelty-free gluten-free @foreach ($products as $product) {{$product->name}} @endforeach
@foreach($productGroups as $group) {{$group->name}}  @endforeach @endsection
  @section('socialUrl', '/top_liste')
  @section('socialTitle', 'Vegelije HALL OF FAME')
  @section('socialDescription', "Vegelije top liste: izlistavanje najčešće pregledanih proizvoda i grupa proizvoda na sajtu")
  @section('ogType', 'article')

@section('content')

<main class="col-12">

<h2 class="c2 text-center"><span class="c1"><strong class="fo2">Vegelije</strong></span> Top 10 </h2>
<h5 class="c2 text-center mb-4">najčešće pregledani proizvodi i grupe</h5>

  <listing-top-products-and-product-groups :products="{{$products}}" :product-groups="{{$productGroups}}"></listing-top-products-and-product-groups>


</main>

@if($secondAd)
<div class="col-12">
  <div class="row d-flex justify-content-center">

<slide-in-view :class-of-div='"col-10  col-md-8 my-2 my-md-3"' :duration='900'>
  <div slot="entering" class="row">
    <div class="col-12">
      @include('includes.ads.SecondAdDown')
    </div>
  </div>
</slide-in-view>

</div>
</div>
@endif


@endsection

<style>
#app{
  /* background-color: rgba(#ffffff, 0) !important; */
  /* background-image: linear-gradient(to right, #d3d589, #fff); */
  /* background-image: linear-gradient(to right, #b1d589, #fff); */
}

#app{
  background-color: rgba(#ffffff, 0) !important;
  /* background-image:  linear-gradient(to right,  #abc835, #dceba0); */
  background-image: linear-gradient(to right, #abc835, #fff);
}

</style>
