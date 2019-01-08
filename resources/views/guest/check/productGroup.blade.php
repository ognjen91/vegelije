@extends('layouts.app')
@section('pageTitle', "Grupa proizvoda ".$product->name . ": provera")




@section('content')


<div class="col-12 col-md-8">
  <div class="row">

    <h1>
      <a href="{{strpos(url()->previous(), config('app.url', 'vegelije') ) !== 0 ? url()->previous() : route('homepage')}}" class="backRouteLink">
        <i class="c1 fas fa-arrow-circle-left ml-3 mt-3 mb-2 backRoute"></i>
      </a>
    </h1>

    {{-- IME, PROIZVODJAC, KATEGORIJA --}}
    <div class="col-12 mb-2 mb-sm-2 basicInfo">
      <div class="col-12 mb-2 mb-sm-3 mb-lg-5 basicInfo">
        <h1 class="text-center w-100 c2 groupName"><strong>Grupa proizvoda: {{$product->name}}</strong></h1>
        <h5 class="text-center w-100 c2">u kategoriji <a href="{{route('categoryProducts', $product->category->name)}}" class="c1Link">{{$product->category->name}}</a></h5>
      </div>
    </div>
    {{-- //IME, PROIZVODJAC, KATEGORIJA --}}

     {{-- OPIS, AKO POSTOJI --}}
      @if($product->description)
     <div class="col-10 offset-1  mb-3 mb-md-2 mb-lg-5 productDescr py-lg-3">
       <h3 class="text-center w-100 c1 underlined"><strong>Dodatne informacije:</strong></h3>
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


@auth
@if(\Auth::user()->hasAnyRole('Admin', 'Moderator'))

    <div class="col-12 col-md-8 my-4 d-flex flex-column justify-content-center">
      <h3 class="text-center mb-3 c2">Admin opcije</h3>
      <a href="{{route('editProductGroup', $product->id)}}" type="button" class="btn btn-primary btn-lg btn-block">Menjajte ovu grupu proizvoda</a>
    </div>

@endif
@endauth

<div class="col-12 col-md-8 my-2 my-md-3">
   <p class="text-center w-100 c2">Uočili ste grešku u podacima o ovoj grupi proizvoda? Imate dodante informacije o istoj? <a href="{{route('suggestEditGroup', $product->id)}}" class="c1Link"><strong class='underlined'>Dojavite nam!</strong></a></p>
</div>

@if($secondAd)
<slide-in-view :class-of-div='"col-10 offset-1 col-md-6 offset-md-1 my-2 my-md-3"' :duration='900'>
  <div slot="entering" class="row">
    <div class="col-12">
      @include('includes.ads.SecondAdDown')
    </div>
  </div>
</slide-in-view>
@endif

<div class="col-12 col-md-8">

  @if(count($productGroupsProducts))
  <div class="row mb-3 mb-md-4 ">
    <h3 class='c2 text-center w-100'>Proizvodi povezani sa grupom proizvoda {{$product->name}}</h3>
  </div>
  <div class="row">

    <div class="col-12 offset-0 linkedProducts">
      <listing-products-and-product-groups :products="{{$productGroupsProducts}}"></listing-products-and-product-groups>
    </div>


  </div>
@else
  <div class="row">
    <h3 class="text-center w-100 c2">Nema proizvoda povezanih sa ovom grupom!</h3>
  </div>
@endif
</div>

<div class="col-12 col-md-8 mt-5">
   <p class="text-center w-100 c2"><small>Grupa proizvoda {{$product->name}} je kreirana {{$product->created_at->format('d. m. Y.')}} i od tada je pregledana
     <strong>{{$product->viewsCount}}</strong> {{$product->viewsCount%10 !== 1? "puta" : "put"}}</small></p>
     @if($product->suggestedBy)<p class="text-center c5"><strong>Hvala {{$product->suggestedBy}} na predlogu i podacima za ovu grupu proizvoda!</strong></p> @endif

</div>


@endsection


<style>
#app{
  background-color: rgba(#ffffff, 0) !important;
  background-image: linear-gradient(to right, #abc835, #fff);
}
</style>
