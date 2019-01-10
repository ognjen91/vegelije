@extends('layouts.app')
@section('pageTitle', 'Proizvođači')
@section('pageDescription')
Vegelije pretraga proizvođača. Pronađite proizvođača i proverite da li su njegovi proizvodi veganski i vegetarijanski. Ukupno {{$manufacturers->count()}} proizvođača u bazi!
@endsection
@section('keywords') proizvođači pretraga vegan vegansko vegetarijansko cruelty-free gluten-free  @endsection
  @section('socialUrl', '/proizvodjaci')
  @section('socialTitle', 'Vegelije: pretraga proizvođača')
  @section('socialDescription', "Vegelije pretraga proizvođača: pronađite svog omiljenog proizvođača i proverite da li su njegovi proizvodi veganski i vegetarijanski")
  @section('ogType', 'article')


@section('content')

<main class="col-12">
  <div class="row">

    <section class="col-2 manufLeftSidebar manufSidebar rounded">
      <p></p>
    </section>

  <section class="col-8 mb-5 px-2 manufPageContent rounded">
    <div class="row">

      <div class="col-12 mb-2 mb-md-3">
        <h1 class="text-center c1 w-100"><span class="fo2">Vegelije:</span> <span class="c2 h4">pretraga proizvođača</span></h1>
        <h5 class="text-center c1 w-100 spaced2"><small>pronađite svog omiljenog proizvođača</small></h5>
      </div>


      <div class="col-12 mb-2 mb-md-3">
        <manufacturers-search></manufacturers-search>
      </div>

    </div>
    <div class="row">
      <div class="col-12 pt-2">
          <manufacturers-results :manufacturers="{{$manufacturers}}"></manufacturers-results>
      </div>
    </div>


  </section>

  <section class="col-2 manufRightSidebar manufSidebar rounded"></section>


  </div>
</main>





@endsection
<style>
  .content{
    min-height: 100vh;
  }
  @media screen and (max-width: 768px){

  .content{
    display: block;

  }
  footer{
    display : none !important;
  }
  #app{
    /* background-color: rgba(142, 60, 203, 0) !important; */
  }
  body {
    /* background-color: rgba(142, 60, 203, 0.2) !important; */
  }
}

@media screen and (max-width:768px){
  .content{
    display : inherit !important;
  }
}


  #app{
    background-color: rgba(#ffffff, 0) !important;
    background-image: linear-gradient(to right, #a074c1, #fff);
  }




</style>
