@if(isset($product->manufacturer_id))
<div class="selectGrupus d-flex flex-wrap">
  <div class="row mb-4">
    <div class="col-12">
      <h5 class="text-center  d-inline-block">Odaberite grupe proizvoda kojem pripada dati proizvod</h5>
      <div class="btn btn-primary c1Button d-inline-block" id="showHideSelectingGroup"><i class="fas fa-angle-double-down"></i> Prikaži/Sakrij</div>
    </div>
    <div class="col-12">
      <h5 class="text-center  d-inline-block c2">Ukoliko nema željene grupe, možete je dodati, pa nakon toga ubaciti ovaj proizvod</h5>
    </div>
  </div>




<div class="row" id='selectingProductGroups'>
  <div class="col-12">
    @foreach($productGroups as $group)
    <div class="form-check form-check-inline mr-2 mr-lg-4 mb-1 mb-lg-2">
    <input class="form-check-input" name="productGroups[]" type="checkbox" id="inlineCheckbox{{$group->id}}" value="{{$group->id}}"
    @errors @if(in_array($group->id, old('productGroups'))) checked @endif
    @else
    @edit @if(in_array($group->id, $productProductGroups)) checked @endif @endedit
    @enderrors>
    <label class="form-check-label" for="inlineCheckbox{{$group->id}}">{{$group->name}}</label>
  </div>
  @endforeach
  </div>
</div>

</div>
@endif
