@extends('layouts.app')
@section('pageTitle', 'Predložite proizvod')
@section('pageDescription')
Najsveobuhvatnije pretraga veganskih i vegetarijanskih proizvoda na Balkanu. Pomognite nam da budemo još bolji, pošaljite nam svoje predloge. Sa vama smo jači!
@endsection
@section('keywords') vegan vegansko vegetarijansko cruelty-free gluten-free zajednica @endsection
  @section('socialUrl', '/predlozite')
  @section('socialTitle', 'Vegelije: predložite proizvod!')
  @section('ogType', 'article')

@section('content')

  <main class="col-10 offset-1 col-md-8 offset-md-2">
    <div class="row">

      <section class="col-12 loggedUser mb-md-4">
        <div class="row d-flex justify-content-end">
          <div class="avatar col-2 col-md-2 col-lg-1">
            <img src="{{$googleUser->user['picture']}}" alt="" class="rounded-circle">
          </div>
          <div class="d-flex flex-column align-items-center">
            <span class="c1"><strong>{{$googleUser->name}}</strong> </span>
            <a href="{{route('googleUserLogout')}}">izlogujte se</a>
          </div>
        </div>
      </section>



      <section class="col-12 mb-3">
        {{-- {{dd($googleUser->name)}} --}}
        <h1 class='fo1 spaced2 mb-2 mb-lg-4 c1'>Predložite proizvod</h1>
        <h4 class='fo1 c2'><strong>{{$googleUser->user['gender'] == 'female'? 'Poštovana' : 'Poštovani'}} {{$googleUser->user['name']}},
        Hvala vam što doprinosite <span class="c1">Vegelijama</span> i vege zajednici!</strong><br>
        Po unosu, proizvod će proći reviziju administratora sajta i biti objavljen u najkraćem roku.</h4>

        <h5 class="fo1 c2">Možete predložiti konkretan proizvod (na primer, "Napolitanke Kokos proizvođača Vege d.o.o"),
        ali i druge proizvode i delove proizvoda, kao što su konzervansi, odrđena vrsta kozmetike i sl.</h5>
      </section>



      <section class="col-12">
        <form action="{{route('storeSuggestion')}}" method="post" enctype="multipart/form-data">

          @csrf


            <div slot='productName'>
              <custom-input :id="'productName'" :name="'name'" :type="'text'"  :required="true"  class="my-3"
              @errors
              :old-value="`{{old('name')}}`"
              @enderrors>
                <template slot='inputTitle'><strong class="fo1 c2">Naziv proizvoda</strong></template>
              </custom-input>
            </div>

            <div slot='productManufacturer'>
              <custom-input :id="'productManufacturer'" :name="'manufacturer'" :type="'text'"  :required="false" class="my-3"
              @errors
              :old-value="`{{old('manufacturer')}}`"
              @enderrors>
                <template slot='inputTitle'><strong class="fo1 c2">Proizvođač <small>(nije obavezno)</small></strong></template>
              </custom-input>
            </div>


          <div slot="productLegality">
            <div class="isVegan my-4">
              <h4><strong class="fo1 c2">Da li je proizvod veganski/vegeterijanski?</strong></h4>
               <div class="form-check">
                 <input class="form-check-input" type="radio" name="legality" value="1"
                 @errors @if(old('legality')==1) checked @endif @else checked @enderrors>
                 <label class="form-check-label fo1 c2">
                   Veganski
                 </label>
               </div>
               <div class="form-check">
                 <input class="form-check-input" type="radio" name="legality" value="2"
                 @errors @if(old('legality')==2) checked @endif  @enderrors>
                 <label class="form-check-label fo1 c2">
                   Vegeterijanski
                 </label>
               </div>
               <div class="form-check">
                 <input class="form-check-input" type="radio" name="legality" value="3"
                 @errors @if(old('legality')==3) checked @endif @enderrors>
                 <label class="form-check-label fo1 c2">
                   Ni vegan, ni vegetarijan
                 </label>
               </div>
             </div>
          </div>


          <div slot="commentEditor" class="my-4">
            <h4 class="fo1 c2"><strong>Komentar</strong> <small>(nije obavezan)</small></h4>
            <textarea name="description" class="form-control productDescription w-100">
              @errors {{old('description')}} @enderrors
            </textarea>
          </div>

          <div class="form-group my-4 c2">
            <h4 class="fo1 c2"><strong>Slike proizvoda</strong></h4>
            <h6 class="fo1 c2">Molimo Vas da nam šaljete isključivo slike koje ste sami uslikali</h6>
            <h6 class="c2 ">Maksimalna veličina svake pojedinačne slike iznosi {{config('app.maxfilesize')}}MB.</h6>

            <multiple-input-files :max-no-of-fields="2" :name="'images'" :must-upload-multiple='true'>
              <h4 slot="errorMsg">Možete poslati najviše 2 slike!</h4>
            </multiple-input-files>
          </div>


          <add-tags  @errors :old-value="'{{ old('tags') }}'" @enderrors>
          </add-tags>

          <be-mentioned :suggested-by="'{{$googleUser->user['name']}}'">
            <template slot='text'>
              Možemo li da zapamtimo vaše ime kao predlagača? <br>
              Ukoliko je odgovor da, vaše ime će biti spomenuto na stranici proizovda, uz zahvalnicu za predlog.
            </template>
          </be-mentioned>

          <input type="submit" class='btn btn-primary btn-lg btn-block vegelijeButton' value="Pošalji!">


        </form>
      </section>
    </div>
  </main>


@endsection

<style>
#app{
  background-color: rgba(#ffffff, 0) !important;
  background-image: linear-gradient(to right, #a074c1, #fff);
}

</style>
