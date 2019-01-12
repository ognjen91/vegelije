@extends('layouts.app')
@section('pageTitle', 'O Vegelijama')
@section('pageDescription')
Najsveobuhvatnije pretraga veganskih i vegetarijanskih proizvoda na Balkanu. Pronađite proizvod za koji niste
sigurni da li je veganski ili vegetarijanski, među {{$noOfProducts}} proizvoda svrstanih u {{$noOfProductGroups}} grupa i {{$noOfCategories}}, ili pretražujte
pomoću nekih od {{$noOfTags}} oznaka.
@endsection
@section('keywords') vegan vegansko vegetarijansko cruelty-free gluten-free @endsection
  @section('socialUrl', '/o_nama')
  @section('socialTitle', 'O Vegelijama')
  @section('socialDescription', "Vegelije - najsveobuhvatnija pretraga vege proizvoda na Balkanu - stranica o nama")
  @section('ogType', 'article')

@section('content')

<main class="col-12">
  <div class="row">

    <section class="col-10 offset-1 col-md-8 offset-md-2">
      <div class="row my-2 mb-md-4 c1">
        <h1 class="c1 text-center w-100"><strong>O Vegelijama</strong></h1>
      </div>
    </section>



    <section class="col-10 offset-1 col-md-8 offset-md-2">
      <h3 class="aboutText px-3 py-2 text-center mb-5">
        <span class="c1"><strong>Vegelije</strong></span> su sajt nastale trudom jednog programera i grupe dobrih
        ljudi koji učestvuju u njihovom održavanju. <br>
        Ukoliko želite da pomognete projekat, to možete učiniti <a href="{{route('suggestProduct')}}" class="c4Link">
        <span class="underlined">učeštvujući u kreiranju sadržaja sajta</span></a>, reklamiranjem na sajtu, ili prateći nas na društvenim mrežama.<br>
        Ako želite da podstatknete razvoj ovog i budućih sličnih projekata, možete to učiniti uplatom na
        <span class='underlined c4'  data-toggle="tooltip" data-placement="top" title='vegelije@gmail.com'>paypal račun</span>. <br>
        Takođe, veoma nam znači Vaše mišljenje!
        Svoja zapažanja i predloge možete poslati na <span class='c4'>vegelije@outlook.com</span>
      </h3>
   </section>


   <section class="col-10 offset-1 col-md-8 offset-md-2">
     <h6 class="text-center c5"><span class='c1'><strong class="fo2 h4">Vegelije</strong></span> u brojkama</h6>
     <p class="c5 text-center"><strong>{{$noOfProducts}}</strong> proizvoda od <strong>{{$noOfManufacturers}}</strong> proizvođača pregledanih ukupno <strong>{{$productViews}}</strong> {{$productViews%10!==1? "puta" : "put"}} <br>
                              <strong>{{$noOfProductGroups}}</strong> grupa proizvoda pregledanih ukupno <strong>{{$productGroupsViews}}</strong> {{$productGroupsViews%10!==1? "puta" : "put"}} <br>
                              <strong>{{$noOfTags}}</strong> oznaka <br>
                              <strong>{{$noOfCategories}}</strong> kategorija <br>
                              <strong>i brojimo...</strong>
                             </p>

  </section>

  <section class="col-12">
    <div class="row socials justify-content-center pt-4 mt-2">

      <a href="{{config('app.fb')}}" class="col-3  col-md-2 col-lg-1">
        <img src="/images/assets/facebook.png" alt="fb icon">
      </a>
      <a href="{{config('app.insta')}}" class="col-3  col-md-2 col-lg-1">
        <img src="/images/assets/instagram.png" alt="fb icon">
      </a>

    </div>
  </section>

  </div>
</main>







@endsection


<style media="screen">
  #app{
    background-color: #8e3ccb !important;
    /* height: 100vh; */
  }

  .aboutText{
    color: #fff;
  }

  #menu{
    /* background-color: #28A745 !important; */
  }
</style>
