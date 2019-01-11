@extends('layouts.error')
@section('pageTitle', 'Vegelije: vege pretraga i provera proizvoda')






@section('content')


<div class="col-12 view404 align-items-center justify-content-center flex-column">
<div class="row d-flex h-100 ">

 <div class="col-12 col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 logo_no_name">
     <img src="/images/assets/logo_no_name.png" alt="">
 </div>

 <div class="col-12">
   <h2 class="spaced text-center text-light">Nema toga što tražite</h2>
   <h5 class='text-center text-light'>Vratite se na <a class="c5Link" href="{{route('homepage')}}">početnu stranu</a></h5>
 </div>


</div>
</div>








@endsection
