@edit
@php
if(isset($product->manufacturer_id)){
  if($product->legalities->count() == 2){
  $legality = 1; //jer samo veganski imaju 2 kategorije, tj ako je veganski onda je i vegeterijanski
  } else {
    $legality = $product->legalities[0]->id;
  }

}

@endphp
@endedit


@if(isset($product))
      @if(isset($product->manufacturer_id))
    <div class="isVegan my-4">
      <h4><strong>Da li je proizvod veganski/vegeterijanski?</strong></h4>
       <div class="form-check">
         <input class="form-check-input" type="radio" name="legality" value="1" checked
         @errors @if(old('legality')==1) checked @endif @enderrors
         @edit @if($legality == 1) checked @endif @endedit>
         <label class="form-check-label">
           Veganski
         </label>
       </div>
       <div class="form-check">
         <input class="form-check-input" type="radio" name="legality" value="2"
         @errors @if(old('legality')==2) checked @endif @enderrors
         @edit @if($legality == 2) checked @endif @endedit>
         <label class="form-check-label">
           Vegeterijanski
         </label>
       </div>
       <div class="form-check">
         <input class="form-check-input" type="radio" name="legality" value="3"
         @errors @if(old('legality')==3) checked @endif @enderrors
         @edit @if($legality ==3) checked @endif @endedit>
         <label class="form-check-label">
           Ni vegan, ni vegetarijan
         </label>
       </div>
     </div>
      @endif
@else

  <div class="isVegan my-4">
    <h4><strong>Da li je proizvod veganski/vegeterijanski?</strong></h4>
     <div class="form-check">
       <input class="form-check-input" type="radio" name="legality" value="1" checked
       @errors @if(old('legality')==1) checked @endif @enderrors
       @edit @if($legality == 1) checked @endif @endedit>
       <label class="form-check-label">
         Veganski
       </label>
     </div>
     <div class="form-check">
       <input class="form-check-input" type="radio" name="legality" value="2"
       @errors @if(old('legality')==2) checked @endif @enderrors
       @edit @if($legality == 2) checked @endif @endedit>
       <label class="form-check-label">
         Vegeterijanski
       </label>
     </div>
     <div class="form-check">
       <input class="form-check-input" type="radio" name="legality" value="3"
       @errors @if(old('legality')==3) checked @endif @enderrors
       @edit @if($legality ==3) checked @endif @endedit>
       <label class="form-check-label">
         Ni vegan, ni vegetarijan
       </label>
     </div>
   </div>


@endif
