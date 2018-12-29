@extends('layouts.app')
@section('pageTitle', 'Kategorije')

@section('content')

<div class="col-12 mb-5">
  <div class="row">
    @foreach ($categories as $name=>$data)
      @php
      $productsNumber = (string)$data['NoOfProducts']; // type casting int to string
      $lastDigitOfProductsNumber =  $productsNumber[strlen($productsNumber)-1]; // 8
      @endphp

      <a href="{{route('categoryProducts', $name)}}" class="col-6 col-md-4 py-5 selectCateogry">
       <h4 class='text-center w-100'>{{$name}}</h4>
       <div class="row">
         <p class='text-center w-100'>{{$data['NoOfProducts']}} {{$lastDigitOfProductsNumber == 1? "konkretan proizvod" : "konkretnih proizvoda"}}
           <br>
           {{$data['NoOfProductGroups']}} grupa proizvoda
         </p>
       </div>
     </a>
    @endforeach
  </div>
</div>



@endsection
