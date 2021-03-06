@extends('layouts.app')
@section('pageTitle', 'Kategorije')
@section('pageDescription')
Najsveobuhvatnije pretraga veganskih i vegetarijanskih proizvoda na Balkanu. Kategorije: @foreach ($categories as $name=>$data) {{$name}} @endforeach.
Pronađite proizvod za koji niste sigurni i proverite!
@endsection
@section('keywords') vegan vegansko vegetarijansko cruelty-free gluten-free @foreach($categories as $name=>$data) {{$name}} @endforeach @endsection
  @section('socialUrl', '/kategorije')
  @section('socialTitle', 'Vege li je: prikaz kategorija')
  @section('socialDescription', "Vegelije prikaz kategorija. Pronađite kategoriju koja Vas zanima i proverite da li se proizvodi povezani sa njom vege!")
  @section('ogType', 'article')


@section('content')

<main class="col-12 mb-2 mb-lg-1">
  <div class="row">
    @foreach ($categories as $name=>$data)
      @php
      $productsNumber = (string)$data['NoOfProducts']; // type casting int to string
      $productGroupsNumber = (string)$data['NoOfProductGroups']; // type casting int to string
      $lastDigitOfProductsNumber =  $productsNumber[strlen($productsNumber)-1]; // 8
      $lastDigitOfProductGroupsNumber =  $productGroupsNumber[strlen($productGroupsNumber)-1]; // 8
      @endphp

      <a href="{{route('categoryProducts', $name)}}" class="col-6 col-md-4 py-5 selectCateogry">
       <h4 class='text-center w-100'>{{$name}}</h4>
       <div class="row">
         <p class='text-center w-100'>{{$data['NoOfProducts']}} @if($lastDigitOfProductsNumber==1) konkretan proizvod
                                                                @elseif(in_array($lastDigitOfProductsNumber, [0,2,3,4] )) konkretna proizvoda
                                                                @else konkretnih proizvoda @endif
           <br>
           {{$data['NoOfProductGroups']}} {{in_array($lastDigitOfProductGroupsNumber, [2,3,4])? "grupe" : "grupa"}} proizvoda
         </p>
       </div>
     </a>
    @endforeach
  </div>
</main>


@if($secondAd)
<aside class="col-10 offset-1 col-md-8 offset-md-2 my-5">
  @include('includes.ads.SecondAdDown')
</aside>
@endif


@endsection


<style>


  #app{
    background-color: rgba(#ffffff, 0) !important;
    background-image: linear-gradient(to right, #ad8dc4, #fff);
  }





</style>
