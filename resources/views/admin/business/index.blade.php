@extends('layouts.admin')

@section('content')

<div class="col-12">
<div class="row">
  <div class="col-12 text-center p-2">
    <a href="{{route('cleanImagesFoldeForm')}}"><h2 class='c1'>Brisanje viška slika</h2></a>
  </div>
  <div class="col-12 text-center p-2">
    <a href="{{route('listImages', 1)}}"><h2 class='c1'>Sve slike</h2></a>
  </div>
  <div class="col-12 text-center p-2">
    <a href="{{route('addModForm')}}"><h2 class='c1'>Moderatori</h2></a>
  </div>
  <div class="col-12 text-center p-2">
    <a href="{{route('showRecommended')}}"><h2 class='c1'>Izbor preporučenih proizvoda</h2></a>
  </div>
  <div class="col-12 text-center p-2">
    <a href="{{route('ads')}}"><h2 class='c1'>Reklame</h2></a>
  </div>

</div>




</div>









@endsection
