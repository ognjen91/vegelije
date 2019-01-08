@extends('layouts.admin')

@section('content')


  <div class="col-12">

  <h1 class="c1 text-center mb-4">Trenutno preporučeni</h1>


    <listing-products-and-product-groups :products="{{$products}}"></listing-products-and-product-groups>


  </div>







@endsection
