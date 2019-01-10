@extends('layouts.app')
@section('pageTitle', 'Oznake')
@section('pageDescription')
Vegelije oznake (tagovi): najsveobuhvatnije pretraga veganskih i vegetarijanskih proizvoda na Balkanu. Pretraga vege proizvoda po tagovima (oznakama).
@endsection
@section('keywords') oznaka oznake tagovi @foreach ($tags as $tag) {{$tag}} @endforeach vegan vegansko vegetarijansko cruelty-free gluten-free  @endsection
  @section('socialUrl', '/oznake')
  @section('socialTitle', 'Vegelije: pretraga po oznakama')
  @section('ogType', 'article')

@section('content')

<main class="col-12">
  <section class="row">
    <div class="col-12 mb-3 mb-md-5">
      <h2 class="text-center c2 underlined"><span class="c1 fo2 h1">Vegelije:</span> oznake</h2>
    </div>
  </section>

<tag-input></tag-input>

<section class="row my-4 px-3 px-md-5">
  @foreach ($tags as $tag)
    <a class="btn btn-primary c1Button rounded mx-2 my-2 " href="{{route('taggedProducts', $tag)}}">{{$tag}}</a>
  @endforeach
</section>




</main>



@if($secondAd)
<div class="col-10 offset-1 col-md-8 offset-md-2 my-5">
  @include('includes.ads.SecondAdDown')
</div>
@endif





@endsection

<style>
#app{
  background-color: rgba(#ffffff, 0) !important;
  background-image: linear-gradient(to right, #a074c1, #fff);
}

@media screen and (max-width:768px){
  .content{
    display : inherit !important;
  }
}
</style>
