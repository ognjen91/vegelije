@extends('layouts.app')
@section('pageTitle', 'Proizvođači')


@section('content')

<div class="col-12">
  <div class="row">

    <div class="col-2 manufLeftSidebar manufSidebar rounded">
      <p></p>

    </div>

  <div class="col-8 mb-5 px-2 manufPageContent rounded">
    <div class="row">

      <div class="col-12 mb-2">
        <h2 class="text-center c1 w-100">Vegelije: <span class="c2">proizvođači</span></h2>
      </div>


      <div class="col-12 mb-2">
        <manufacturers-search></manufacturers-search>
      </div>

    </div>
    <div class="row">
      <div class="col-12 pt-2">
          <manufacturers-results :manufacturers="{{$manufacturers}}"></manufacturers-results>
      </div>
    </div>


  </div>

  <div class="col-2 manufRightSidebar manufSidebar rounded">

  </div>


  </div>
</div>





@endsection
<style>
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
