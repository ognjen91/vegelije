@extends('layouts.admin')

@section('content')

<div class="col-10 offset-1 col-md-8 offset-1 my-4">
  <a href="{{route('editProduct', $suggestion->product->id)}}" class="btn btn-primary vegelijeButton"><strong>Nazad na proizvod {{$suggestion->product->name}}</strong></a>
</div>


<div class="col-10 offset-1 col-md-8 offset-1 my-4">
  <div class="row">
    <h4 class="c2">
      Predlog za promenu podataka za <a  class="c2Link" href="{{route('editProduct', $suggestion->product->id)}}">
        proizvod {{$suggestion->product->name}} proizvođača {{$suggestion->product->manufacturer->name}}
      </a>
     </h4>
  </div>
</div>

<div class="col-10 offset-1 col-md-8 offset-md-2">
  <div class="row mb-3">
    @if($suggestion->suggestedBy)
      <h5 class="c2">{{$suggestion->suggestedBy}} ({{$suggestion->proposerEmail}}) je napisao:</h5>
    @else
      <h5 class="c2">Anonimni posetilac je napisao:</h5>
    @endif
  </div>
  <div class="row">
    <div class="col-12">
      {!! $suggestion->suggestion!!}
    </div>
  </div>
</div>







@endsection
