@extends('layouts.app')
@section('pageTitle', 'Predložite proizvod')


@section('content')

@if(isset($googleUser))
  @include('guest.pages.suggest.'.$view)
@else
  @include('guest.pages.suggest.pleaseLogin')
@endif
@endsection





<style>
#app{
  background-color: rgba(#ffffff, 0) !important;
  background-image: linear-gradient(to right, #a074c1, #fff);
}

</style>
