@edit
@if($product->declarationImage)
<div class="row my-3">
  <div class="col-12">
    <h4>Trenutna slika deklaracije.</h4>
  </div>
  <div class="col-12">
    <img src="/images/{{$product->declarationImage}}" alt="">
  </div>
</div>
@else
  <div class="row my-3">
    <div class="col-12">
      <h4>Slika deklaracije nije postavljena.</h4>
    </div>
  </div>
@endif
@endedit
<div class="form-group">
  <label for="productDeclaration"><h4><strong>
    @edit
    @if($product->declarationImage)
    Promenite sliku deklaracije
    @else
    Ubacite sliku deklaracije proizvoda (nije obavezno)
    @endif
    @else
    Ubacite sliku deklaracije proizvoda (nije obavezno)
    @endedit
  </strong></h4></label>
  <input type="file" class="form-control-file" id="productDeclaration" name="declarationImage">
</div>


<hr class="my-2">
