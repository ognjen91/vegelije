@extends('layouts.app')
@section('pageTitle', "Proizvod ".$product->name . ": vege provera")
@section('pageDescription')
Proverite da li je proizvod {{$product->name}}  proizvođača {{$product->manufacturer->name}} veganski i vegetarijanski.
Proizvod {{$product->name}} iz kategorije {{$product->category->name}} se nalazi u bazi Vegelija  - dođite i proverite. Dobrodošli na Vegelije!
@endsection
@section('keywords') {{$product->name}} provera vegan vegansko vegetarijansko cruelty-free gluten-free @foreach($product->tags as $tag) {{$tag->name}} @endforeach @endsection
@section('socialUrl', '/proizvod/'.$product->id)
@section('socialTitle', 'Vege li je proizvod '.$product->name."?")
@section('socialImage', $product->image !== 'placeholder.png'? $product->image : '/assets/vegelije.jpg')
@section('socialDescription', "Provera da li je proizvod ". $product->name. " proizvođača ".$product->manufacturer->name." veganski i vegetarijanski")
@section('ogType', 'article')


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

{{-- {{dd($product, $productsWithCommonTags)}} --}}

<main class="col-12 col-md-8 productContent @if($product->isRecommended) pt-2 pt-md-3 @endif" >
  <div class="row">
    {{-- {{ $url = strpos($url, 'http') !== 0 ? "http://$url" : $url }} --}}

    {{-- IME, PROIZVODJAC, KATEGORIJA --}}

    @include('includes.goBack')

    <section class="col-12 mb-2 mb-sm-3 mb-lg-5 basicInfo">

      <h1 class="text-center w-100 c5"> {{$product->name}}
      @if($product->isRecommended)
       <sup id="vegelijeRecommend" class="c5 fo2">
         <small class='fo2'><strong class="c1 fo2"> Vegelije</strong> preporučuju</small>
       </sup> @endif
     </h1>
      <h3 class="text-center w-100 c5">@if(isset($product->manufacturer_id))proizvodi @endif<a href="{{isset($product->manufacturer_id)? route('manufacturerProductsGuest', $product->manufacturer->id) : "#"}}" class="underlined c5Link">{{isset($product->manufacturer_id)? $product->manufacturer->name : "grupa proizvoda"}}</a></h3>
      <h5 class="text-center w-100 c5">u kategoriji <a href="{{route('categoryProducts', $product->category->name)}}" class="underlined c5Link">{{$product->category->name}}</a></h5>

    </section>
    {{-- //IME, PROIZVODJAC, KATEGORIJA --}}


    {{-- LEGALITY IMG --}}
    <section class="col-12 col-sm-8 offset-sm-2  col-lg-6 mt-lg-1 @if($legality !== 'illegal') col-lg-6 offset-lg-1 @else col-lg-8 offset-lg-2  @endif  d-flex justify-content-center mb-2 mb-md-3 mb-lg-1">
      <div class="legalityImage @if($legality == 'illegal') illegality @endif">
        <img src="/images/assets/{{$legality}}.png" alt="legality: {{$legality}} product">
      </div>
    </section>
    {{-- //LEGALITY IMG --}}


      {{-- DA LI JE OK ZA VEGANE I VEGETARIJANCE --}}
        @if(count($okFor))
      <section class="rounded  okFor col-8 offset-2 px-2 py-0 col-lg-3  offset-lg-0 mb-3 mb-md-2  d-flex justify-content-center align-items-center flex-column">
          <p class='text-light text-center w-100 spaced'><strong>Proizvod je pogodan {{$legality == "vegetarian"? "za vegetarijance, ali ne i za vegane" : "i za vegane i za vegetarijance"}}</strong>
          <br><p class="c1" data-toggle="tooltip" data-placement="top"
           @if($product->category->name !== 'ostalo')title="{{$legality == "vegetarian"? "Proizvod sadrži sastojke životinjskog porekla, ali ne sadrži meso. Za dodatne informacije, molimo proverite opis ili deklaraciju proizvoda." : "Proizvod ne sadrži sastojke životinjskog porekla. Da proverite da li je cruelty-free, molimo proverite dodate informacije ili deklaraciju proizvoda"}}"
           @else title="{{$legality == "vegetarian"? "Proizvod sadrži sastojke životinjskog porekla. Molimo proverite dodatne informacije ili deklaraciju proizvoda." : "Proizvod ne sadrži sastojke životinjskog porekla i nije testiran na životinjama"}}" @endif>Sta ovo znači <i class="c1 far fa-question-circle"></i></p>
        </p>

      </section>
        @endif
      {{-- //DA LI JE OK ZA VEGANE I VEGETARIJANCE --}}


      {{-- SLIKE --}}
      <section class="col-12 mb-4 mb-lg-3 pl-md-5 mt-lg-3 productImgs">
      @include('guest.check.images')
      @if($product->images->count()<4)
      <h4 class="c5 my-2 px-2 px-md-0 text-center">Imate sliku ovog proizvoda? Pošaljite nam je
        <a class="c5Link" href="{{route('suggestImage', $product->id)}}">
        <strong class='underlined'>ovde</strong>
      </a>
    </h4>
      @endif
    </section>




     {{-- OPIS, AKO POSTOJI --}}
      @if($product->description)
     <section class="col-10 offset-1 col-lg-10 offset-lg-1 mb-1 mb-md-2 mt-lg-2 productDescr pt-lg-4 pb-lg-1 mb-lg-5">
       <h3 class="text-center w-100 c5 underlined"><strong>Dodatne informacije:</strong></h3>
       <div class="text-center w-100 px-1 px-md-2 text-light">{!! $product->description !!}</div>
     </section>
      @endif
     {{-- //OPIS, AKO POSTOJI --}}
  </div>
</main>


  <slide-in-view :class-of-div='"col-10 offset-1 col-md-6 offset-md-1 "' :duration='900'>
    <div slot="entering" class="row">
      <div class="col-12">
        @include('includes.ads.MainAdDown')
      </div>
    </div>
  </slide-in-view>





{{-- TAGOVI --}}
<aside class="col-12 col-md-4 productTags mb-2 mb-md-4 pr-lg-5">
  @include('guest.check.tags')
</aside>
{{-- //TAGOVI --}}

@if(count($product->productGroups))
<section class="col-12 offset-md-1 col-md-6 linkedGroups mt-2 pt-5 px-md-4">
  @include('guest.check.linkedGroups')
</section>
@endif


<section class="col-12 col-md-8 mt-5">
   <p class="text-center w-100 c5"><small>Proizvod {{$product->name}} proizvođača {{$product->manufacturer->name}} je ubačen {{$product->created_at->format('d. m. Y.')}} i od tada je pregledan
     <strong>{{$product->viewsCount}}</strong> {{$product->viewsCount%10 !== 1? "puta" : "put"}}</small></p>

  @if($product->suggestedBy)<p class="text-center c5"><strong>Hvala {{$product->suggestedBy}} na predlogu i podacima za ovaj proizvod!</strong></p> @endif
</section>

<section class="col-12 col-md-8 mt-1 mb-3">
   <p class="text-center w-100 c5">Uočili ste grešku u podacima o ovom proizvodu? Imate dodante informacije o proizvodu? <a href="{{route('suggestEdit', $product->id)}}" class="c1Link"><strong class='underlined'>Dojavite nam!</strong></a></p>
</section>

@if(!$product->isRecommended)
@if($recommendedProducts->count())
<section class="col-12 col-md-8 mt-1 mb-3 mb-lg-5">
@include('guest.check.recommendedProducts')
</section>
@endif

@if($similarProducts->count())
<section class="col-12 col-md-8 mt-2 mt-lg-3 mb-4 mb-lg-4">
@include('guest.check.similarProducts')
</section>
@endif
@endif

<div class="col-12 col-md-8 my-3">
  @include('includes.ads.SecondAdDown')
</div>

@auth


    <div class="col-12 col-md-8 my-4 d-flex flex-column justify-content-center">
      <h3 class="text-center mb-3 c5">Admin opcije</h3>
      <a href="{{route('editProduct', $product->id)}}" type="button" class="btn btn-primary btn-lg btn-block">Menjajte ovaj proizvod</a>
    </div>


@endauth



@endsection
