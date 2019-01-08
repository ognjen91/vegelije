@extends('layouts.app')
@section('pageTitle', 'Predložite proizvod')


@section('content')

<div class="col-12 d-flex flex-column pt-4 align-items-center">
  <h2 class='w-100 text-center'><strong>Dobrodošli, {{$googleUser->getName()}}</strong></h2>
  <h5 class='w-100 text-center'>Uskoro ćete biti redirektovani na stranicu za predloge</h5>
</div>







@endsection

<script type="text/javascript">
  setTimeout(()=>window.location.replace("{{session('suggestionPageRedirectUrl', route('suggestProduct'))}}"), 3500)
</script>


<style media="screen">
  .content{
    height: 100vh;
  }
</style>
