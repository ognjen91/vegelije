@extends('layouts.app')
@section('pageTitle', 'Oznake')


@section('content')

<div class="col-12">
  <div class="row">
    <div class="col-12 mb-3 mb-md-5">
      <h2 class="text-center c2 underlined"><span class="c1 fo2 h1">Vegelije:</span> oznake</h2>
    </div>
  </div>

<tag-input></tag-input>

<div class="row my-4 px-3 px-md-5">
  @foreach ($tags as $tag)
    <a class="btn btn-primary c1Button rounded mx-2 my-2 " href="{{route('taggedProducts', $tag)}}">{{$tag}}</a>
  @endforeach
</div>




</div>



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
