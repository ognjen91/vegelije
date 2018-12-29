@extends('layouts.app')
@section('pageTitle', 'Grupe proizvoda')




@section('content')

<div class="col-12 mb-3 mb-md-5">
  <h2 class="text-center c1">Vegelije: <span class="c2">Grupe proizvoda</span></h2>
  <div class="row">
  <p class="col-12 selectListing d-flex mb-2 mb-md-3 text-center">

@if(!isset($_GET['sortiranje']))
    <a href="{{route(\Route::currentRouteName(), ['sortiranje'=>'ime_asc'])}}" class='c2Link mr-2'>
      <small><i class="fas fa-caret-down"></i>SORTIRAJ PO NAZIVU</small>
    </a>
    <a href="{{route(\Route::currentRouteName(), ['sortiranje'=>'proizvodi_desc'])}}" class='c2Link ml-2'>
      <small>SORTIRAJ PO BROJU PROIZVODA</small>
    </a>
@else
  <a href="{{$_GET['sortiranje'] == 'ime_asc'? route(\Route::currentRouteName(), ['sortiranje'=>'ime_desc']) : route(\Route::currentRouteName(), ['sortiranje'=>'ime_asc'])}}" class='c2Link mr-2'>
    <small>@if($_GET['sortiranje']=='ime_asc') <i class="fas fa-caret-up"></i> @elseif ($_GET['sortiranje']=='ime_desc') <i class="fas fa-caret-down"></i>  @endif SORTIRAJ PO NAZIVU</small>
  </a>
  <a href="{{$_GET['sortiranje'] == 'proizvodi_asc'? route(\Route::currentRouteName(), ['sortiranje'=>'proizvodi_desc']) : route(\Route::currentRouteName(), ['sortiranje'=>'proizvodi_asc'])}}" class='c2Link ml-2'>
    <small>@if($_GET['sortiranje']=='proizvodi_asc') <i class="fas fa-caret-up"></i> @elseif ($_GET['sortiranje']=='proizvodi_desc') <i class="fas fa-caret-down"></i> @endif  SORTIRAJ PO BROJU PROIZVODA</small>
  </a>
@endif

  </p>
</div>
</div>

<div class="col-12">
  <div class="row d-flex flex-wrap justify-content-between">
 @foreach ($productGroups as $key=>$group)
    <div class="col-6 col-md-4 col-lg-3 mb-2 mb-md-2 mb-lg-3  text-center d-flex justify-content-center">
      <a href="{{route('checkProductGroup', $group->id)}}" class="listedGroup rounded px-4 py-1 noUnderline w-100 d-flex flex-column justify-content-center">
        <h3 class='c5 d-none d-md-block'>{{$group->name}}</h3>
        <h5 class='c5 d-md-none'>{{$group->name}}</h5>

        <p class='text-light'> {{$group->products->count()}} {{$group->products->count()%10 == 1? "proizvod" : "proizvoda"}}</p>
      </a>
    </div>


 @endforeach
  </div>
</div>









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
