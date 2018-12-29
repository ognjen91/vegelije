@if($product->image)
<div class="row my-3">
  <div class="col-12">
    <h4>Predložena slika proizvoda</h4>
  </div>
  <div class="col-12">
    <div class="activeProductImage">
      <img src="/images/{{$product->image}}" alt="">
    </div>
  </div>
</div>
@else
  <div class="row my-3">
    <div class="col-12">
      <h4>Korisnik nije predložio sliku proizvoda</h4>
    </div>
  </div>
@endif
<div class="form-group">
  <label for="productImage"><h4><strong>
    @edit
    Promenite sliku proizvoda
    @else
    Slika proizvoda (nije obavezno)
    @endedit
  </strong></h4></label>
  <input type="file" class="form-control-file" id="productImage" name="image">
</div>

<hr class='my-2'>
