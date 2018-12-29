@extends('layouts.app')
@section('pageTitle', 'O Vegelijama')


@section('content')

<div class="col-12">
  <div class="row">
    <div class="col-10 offset-1 col-md-8 offset-md-2">
      <div class="row my-2 mb-md-4 c1">
        <h1 class="c1 text-center w-100"><strong>O Vegelijama</strong></h1>
      </div>
    </div>
  </div>
  <div class="col-10 offset-1 col-md-8 offset-md-2">

    <h3 class="aboutText px-3 py-2 text-center">
      <span class="c1"><strong>Vegelije</strong></span> su sajt nastale trudom jednog programera i grupe dobrih
      ljudi koji dobrovoljno učestvuju u njihovom održavanju. <br>
      Ukoliko želite da pomognete projekat, to možete učiniti <a href="{{route('suggestProduct')}}" class="c4Link">
      <span class="underlined">učeštvujući u kreiranju sadržaja sajta</span></a>, reklamiranjem na sajtu,
       uplatom na <a href="#" class="c4Link"> <span class="underlined">paypal račun</span></a>, ili prateći nas na društvenim mrežama.<br>
      Takođe, veoma nam znači Vaše mišljenje!
      Svoja zapažanja i predloge možete poslati na <span class='c4'>vegelije@gmail.com</span>
    </h3>

  </div>
</div>







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
