@extends('layouts.admin')
@section('pageTitle', 'ADMIN DASHBOARD')


@section('content')




<div class="col-12">
    <ul class="adminOptions row">
      <li class="py-4 px-1 my-3 fo1 col-12 col-lg-6 my-lg-0">

          <h3 class="c1 spaced">Konkretni proizvodi</h3>
          <h5 class="mb-4">Ovo su proizvodi koji imaju proizvođača: npr "Napolitanke" od Štarka
            ili "Pasta za zube sa ukusom eukaliptusa" od Colagate-a</h5>
        <a href="{{route('products')}}" class="btn btn-success btn-lg">pogledajte</a>
      </li>

      <li class="py-4 px-1 my-3 fo1 col-12 col-lg-6 my-lg-0">

          <h3 class="c1 spaced">Grupe proizvoda</h3>
          <h5 class="mb-4">Npr 'pcelinji vosak' ili konzervansi</h5>
          <a href="{{route('productGroups')}}" class="btn btn-success btn-lg">pogledajte</a>
      </li>

      <li class="py-4 px-1 my-3 fo1 col-12 col-lg-6 my-lg-0">

          <h3 class="c1 spaced">Zahtevi</h3>
          <h5 class="mb-4">Odlučujte o predlozima koje šalju posetioci sajta</h5>
       <a href="{{route('suggestions')}}" class="btn btn-success btn-lg">pogledajte</a>
      </li>

      <li class="py-4 px-1 my-3 fo1 col-12 col-lg-6 my-lg-0">

          <h3 class="c1 spaced">Proizvođači</h3>
          <h5 class="mb-4">Pogledajte spisak proizvođača, dodajte nove i mijenjajte postojeće</h5>
       <a href="{{route('manufacturers')}}" class="btn btn-success btn-lg">pogledajte</a>
      </li>




    </ul>
</div>



@endsection
