@extends('layouts.app')
@section('pageTitle', $pageTitle)

@section('content')

<div class="col-12 d-flex justify-content-center align-items-center">
  <h2 class="text-danger text-center">{{$msg}}</h2>
</div>



@endsection

<style>
.content{
  min-height: 70vh;
}

</style>
