@extends('layouts.app')
@section('pageTitle', 'Predložite sliku')


@section('content')


  <div class="col-10 offset-1 col-md-8 offset-md-2 loggedUser mb-md-4">
    <div class="row d-flex justify-content-end">
      <div class="avatar col-2 col-md-2 col-lg-1">
        <img src="{{$googleUser->user['picture']}}" alt="" class="rounded-circle">
      </div>
      <div class="d-flex flex-column align-items-center">
        <span class="c1"><strong>{{$googleUser->name}}</strong> </span>
        <a href="{{route('googleUserLogout')}}">izlogujte se</a>
      </div>
    </div>
  </div>

<div class="col-10 offset-1 col-md-8 offset-md-2 mt-2">

  <div class="row">
    <div class="col-12">
    <h4 class="c2 text-center">Predložite novu sliku za proizvod {{$product->name}} proizvođača {{$product->manufacturer->name}}</h4>
    <h5 class='c2 text-center'>
      @if(!$product->images->count())
      Nemamo ni jednu sliku za ovaj proizvod.
      @else
      Ovaj proizvod već ima {{$product->images->count()}} {{$product->images->count()==1?"sliku":"slike"}}.
      @endif
      Možete predložiti @if($product->images->count())još@endif do {{4-$product->images->count()}}
      {{4-$product->images->count() == 1? "sliku" : "slike"}}.</h5>
      </div>



    <form action="{{route('storeImageSuggestion', $product->id)}}" class="col-10 offset-1 col-md-8 offset-md-2 py-2" method="post" enctype="multipart/form-data">
      @csrf
    <div class="row h3 c2 my-2">Odabir slika</div>
    <multiple-input-files class='mb-4' :max-no-of-fields="{{4-$product->images->count()}}" :name="'images'" :must-upload-multiple='true'>
      <h4 slot="errorMsg">Možete poslati najviše {{4-$product->images->count()}} slike za ovaj proizvod!</h4>
    </multiple-input-files>
      <input type="submit" value='Pošaljite slike!' class='btn btn-block btn-lg vegelijeButton mt-4'>
    </form>


  </div>




  </div>





@endsection

<style>
.content{
  min-height: 70vh;
}
</style>
