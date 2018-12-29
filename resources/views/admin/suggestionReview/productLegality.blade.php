<div class="isVegan my-4">
  <h4><strong>Da li je proizvod veganski/vegeterijanski?</strong></h4>
  <h5><strong>Predloženo od korisnika je automatski izabrano</strong></h5>
   <div class="form-check">
     <input class="form-check-input" type="radio" name="legality" value="1" checked
     @errors @if(old('legality')==1) checked @endif
     @else
       @if($suggestion->legality == 1) checked @endif
    @enderrors>
     <label class="form-check-label">
       Veganski
     </label>
   </div>
   <div class="form-check">
     <input class="form-check-input" type="radio" name="legality" value="2"
     @errors @if(old('legality')==2) checked @endif
     @else
       @if($suggestion->legality == 2) checked @endif
    @enderrors>
     <label class="form-check-label">
       Vegeterijanski
     </label>
   </div>
   <div class="form-check">
     <input class="form-check-input" type="radio" name="legality" value="3"
     @errors @if(old('legality')==3) checked @endif
     @else
       @if($suggestion->legality == 3) checked @endif
    @enderrors>
     <label class="form-check-label">
       Ni vegan, ni vegetarijan
     </label>
   </div>
 </div>
