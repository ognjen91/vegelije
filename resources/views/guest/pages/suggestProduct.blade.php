@extends('layouts.app')
@section('pageTitle', 'Predložite proizvod')


@section('content')

<div class="col-10 offset-1 col-md-8 offset-md-2">
  <div class="row">
    <div class="col-12 mb-3">
      <h1 class='fo1 spaced2 mb-2 mb-lg-4 c1'>Predložite proizvod</h1>
      <h4 class='fo1 c2'><strong>Hvala vam što doprinostie <span class="c1">Vegelijama</span> i vege zajednici!</strong><br>
      Po unosu, proizvod će proći reviziju administratora sajta i biti objavljen u najkraćem roku.</h4>

      <h5 class="fo1 c2">Možete predložiti konkretan proizvod (na primer, "Napolitanke Kokos proizvođača Vege d.o.o"),
      ali i druge proizvode i delove proizvoda, kao što su konzervansi, odrđena vrsta kozmetike i sl.</h5>
    </div>



    <div class="col-12">
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
            {{-- @errors {{old('description')}} @enderrors --}}
          </textarea>
        </div>

        <div class="form-group my-4">
          <label for="productImage"><h4 class="fo1 c2"><strong>Slika proizvoda <small>(nije obavezno)</small></strong></h4><br>
          <h6 class='c2'>*Molimo Vas da nam šaljete samo slike koje ste sami slikali.</h6></label>
          <input type="file" class="form-control-file" id="productImage" name="image">
        </div>

        <div class="form-group my-4">
          <label for="productDeclaration"><h4 class="fo1 c2"><strong>Slika deklaracije proizvoda <small>(ako postoji, nije obavezno)</small></strong></h4></label>
          <input type="file" class="form-control-file" id="productDeclaration" name="declarationImage">
        </div>


        <add-tags  @errors :old-value="'{{ old('tags') }}'" @enderrors>
        </add-tags>


        <input type="submit" class='btn btn-primary btn-lg btn-block coloredBtn' value="Pošalji!">


      </form>
    </div>
  </div>
</div>







@endsection

<style>
#app{
  background-color: rgba(#ffffff, 0) !important;
  background-image: linear-gradient(to right, #a074c1, #fff);
}
</style>
