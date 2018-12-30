@extends('layouts.app')
@section('pageTitle', "Proizvod ".$product->name . ": provera")


@php
  if(count($product->legalities) == 2){
     $legality = "vegan";
     $okFor = ['vegane', 'vegetarijance'];
  } else {
     $legality = $product->legalities[0]->name;
     $okFor = $legality == 'vegetarian'? ['vegetarijance'] : [];
  }
@endphp


@section('content')


<div class="col-12 col-md-8">
  <div class="row">
    {{-- {{ $url = strpos($url, 'http') !== 0 ? "http://$url" : $url }} --}}

    {{-- IME, PROIZVODJAC, KATEGORIJA --}}
    <div class="col-12 mb-2 mb-sm-3 mb-lg-5 basicInfo">
      <h1><a href="{{strpos(url()->previous(), config('app.url', 'vegelije') ) !== 0 ? url()->previous() : route('homepage')}}" class="c1Link"><i class="fas fa-arrow-circle-left float-left position-absolute pl-4"></i></a></h1>
      <h1 class="text-center w-100 c5"> {{$product->name}}</h1>
      <h3 class="text-center w-100 c5">@if(isset($product->manufacturer_id))proizvodi @endif<a href="{{isset($product->manufacturer_id)? route('manufacturerProductsGuest', $product->manufacturer->id) : "#"}}" class="underlined c5Link">{{isset($product->manufacturer_id)? $product->manufacturer->name : "grupa proizvoda"}}</a></h3>
      <h5 class="text-center w-100 c5">u kategoriji <a href="{{route('categoryProducts', $product->category->name)}}" class="underlined c5Link">{{$product->category->name}}</a></h5>

    </div>
    {{-- //IME, PROIZVODJAC, KATEGORIJA --}}


    {{-- LEGALITY IMG --}}
    <div class="col-12 col-sm-8 offset-sm-2  col-lg-6 mt-lg-1 @if($legality !== 'illegal') offset-lg-1 @else offset-lg-3  @endif  d-flex justify-content-center mb-4">
      <div class="legalityImage">
        <img src="/images/assets/{{$legality}}.png" alt="legality: {{$legality}} product">
      </div>
    </div>
    {{-- //LEGALITY IMG --}}


      {{-- DA LI JE OK ZA VEGANE I VEGETARIJANCE --}}
        @if(count($okFor))
      <div class="col-8 offset-2 p-2  col-lg-3  offset-lg-0 mb-4  d-flex justify-content-center align-items-center flex-column">
          <p class='text-light text-center w-100 p-2 p-lg-2 rounded  okFor'><strong>Proizvod je pogodan {{$legality == "vegetarian"? "za vegetarijance, ali ne i za vegane" : "i za vegane i za vegetarijance"}}</strong>
          <br><i class="far fa-question-circle text-light" data-toggle="tooltip" data-placement="top"
           @if($product->category->name !== 'ostalo')title="{{$legality == "vegetarian"? "Proizvod sadrži sastojke životinjskog porekla, ali ne sadrži meso. Za dodatne informacije, molimo proverite opis ili deklaraciju proizvoda." : "Proizvod ne sadrži sastojke životinjskog porekla"}}"
           @else title="{{$legality == "vegetarian"? "Proizvod sadrži sastojke životinjskog porekla. Molimo proverite dodatne informacije ili deklaraciju proizvoda." : "Proizvod ne sadrži sastojke životinjskog porekla"}}" @endif></i>
        </p>

      </div>
        @endif
      {{-- //DA LI JE OK ZA VEGANE I VEGETARIJANCE --}}


     {{-- OPIS, AKO POSTOJI --}}
      @if($product->description)
     <div class="col-8 offset-2 col-lg-10 offset-lg-1 mb-3 mb-md-2 mb-lg-5 productDescr py-lg-4 rounded">
       <h3 class="text-center w-100 c5 underlined"><strong>Dodatne informacije:</strong></h3>
       <div class="text-center w-100 px-2 text-light">{!! $product->description !!}</div>
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
<div class="col-12 col-md-4 productTags mb-4 pr-lg-5">
  @include('guest.check.tags')
</div>
{{-- //TAGOVI --}}

@if(count($product->productGroups))
<div class="col-12 offset-md-1 col-md-6 linkedGroups mt-2 pt-5 px-md-4">
  @include('guest.check.linkedGroups')
</div>
@endif


<div class="col-12 col-md-8 mt-5">
   <p class="text-center w-100 c5"><small>Proizvod {{$product->name}} proizvođača {{$product->manufacturer->name}} je ubačen {{$product->created_at->format('d. m. Y.')}} i od tada je pregledan
     <strong>{{$product->viewsCount}}</strong> {{$product->viewsCount%10 !== 1? "puta" : "put"}}</small></p>
</div>


@endsection
