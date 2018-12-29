@extends('layouts.app')
@section('pageTitle', "Grupa proizvoda ".$product->name . ": provera")




@section('content')


<div class="col-12 col-md-8">
  <div class="row">
    {{-- {{ $url = strpos($url, 'http') !== 0 ? "http://$url" : $url }} --}}

    {{-- IME, PROIZVODJAC, KATEGORIJA --}}
    <div class="col-12 mb-2 mb-sm-3 mb-lg-5 basicInfo">
      <div class="col-12 mb-2 mb-sm-3 mb-lg-5 basicInfo">
        <h1><a href="{{strpos(url()->previous(), config('app.url', 'vegelije') ) !== 0 ? url()->previous() : route('homepage')}}" class="c1Link"><i class="fas fa-arrow-circle-left float-left position-absolute pl-4"></i></a></h1>
        <h1 class="text-center w-100 c2">Grupa proizvoda: {{$product->name}}</h1>
        <h5 class="text-center w-100 c2">u kategoriji <a href="{{route('categoryProducts', $product->category->name)}}" class="c1Link">{{$product->category->name}}</a></h5>
      </div>
    </div>
    {{-- //IME, PROIZVODJAC, KATEGORIJA --}}

     {{-- OPIS, AKO POSTOJI --}}
      @if($product->description)
     <div class="col-8 offset-2 col-lg-11 offset-lg-0 mb-3 mb-md-2 mb-lg-5 productDescr py-lg-4">
       <h3 class="text-center w-100 c2 underlined">Dodatne informacije:</h3>
       <div class="text-center w-100 px-2 c2">{!! $product->description !!}</div>
     </div>
      @endif
     {{-- //OPIS, AKO POSTOJI --}}


     {{-- SLIKE --}}
     <div class="col-12 mb-4 pl-md-5 productImgs">
     @include('guest.check.images')
     </div>
     {{-- //SLIKE --}}


  </div>
</div>



{{-- TAGOVI --}}
<div class="col-12 col-md-4 productTags mb-3 pr-lg-5">
  @include('guest.check.tags')
</div>
{{-- //TAGOVI --}}


<div class="col-12 col-md-8">

  @if(count($productGroupsProducts))
  <div class="row mb-3 mb-md-4">
    <h3 class='c2 text-center w-100'>Proizvodi povezani sa grupom proizvoda {{$product->name}}</h3>
  </div>
  <div class="row">

    <div class="col-12 offset-0">
      <listing-products-and-product-groups :products="{{$productGroupsProducts}}"></listing-products-and-product-groups>
    </div>


  </div>
@else
  <div class="row">
    <h3 class="text-center w-100 c2">Nema proizvoda povezanih sa ovom grupom!</h3>
  </div>
@endif
</div>





@endsection


<style>
#app{
  background-color: rgba(#ffffff, 0) !important;
  background-image: linear-gradient(to right, #af92c4, #fff);
}
</style>
