<div class="row">
{{-- {{dd($oldTerm, $oldManuf)}} --}}

<div class="col-10 pt-3 py-lg-3">
<div class="row">
<div class="col-12 col-lg-7" >
<div class=" row textAndSearchBar">
{{-- MALI EKRANI --}}
<label for="productBar" class="col-form-label col-3 col-sm-3 d-md-none"><h5 class="text-center">Traži</h5></label>
{{-- VECI EKRANI --}}
<label for="productBar" class="col-form-label  col-md-4 col-lg-4 d-none d-md-inline-block" ><h4 class="text-center">Proizvod</h4></label>

<div class="col-9 col-sm-9 col-md-8 col-lg-8">
<product-bar
 @if($oldTerm) :previously-searched-term="'{{$oldTerm}}'" @endif
 @if($oldManuf) :previously-searched-manufacturer="'{{$oldManuf}}'" @endif>
 </product-bar>
<product-suggestions></product-suggestions>
</div>
</div>
</div>



<div class="col-12 col-lg-5">
<div class=" row textAndSearchBar">
{{-- MALI EKRANI --}}
<label for="manufacturerBar" class="col-form-label col-3 col-sm-3 d-md-none"><h5 class="text-center">od</h5></label>
{{-- VECI EKRANI --}}
<label for="manufacturerBar" class="col-form-label d-none col-md-4 col-lg-4 d-md-inline-block"><h4 class="text-center">Proizvođač</h4></label>


<div class="col-9 col-sm-9 col-md-8 col-lg-8">
<manufacturer-bar :placeholder="'Svi proizvođači / neobavezno polje'"></manufacturer-bar>
<manufacturer-suggestions :manufacturers='{{$manufacturers}}'></manufacturer-suggestions>
</div>

</div>

</div>
</div>
</div>
<div class="col-2 searchBtn">
  <search-button></search-button>
</div>

</div>
