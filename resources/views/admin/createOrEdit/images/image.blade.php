<div class="row my-5">
<div class="col-12">
  <h4 class="c2">Izbor profilne slike</h4>
</div>
</div>

@edit
<div class="row my-3">
  <div class="col-12">
    @if($product->image == 'placeholder.png')
      <h4 class="mb-2" >Profilna slika proizvoda nije odabrana i dok je ne odaberete,
        prikazivaće se default slika
      </h4>
    @endif
    <h5 class="mb-5">Dodajte nove slike {{isset($product->manufacturer_id)? "ovog proizvoda" : "ove grupe proizvoda"}} ili izbrišite stare
      @php $routeParam = isset($product->manufacturer_id)? "Product" : "ProductGroup" @endphp
      <a href="{{route('editImages', [$routeParam, $product->id])}}" class="c2Link">
      OVDJE
      </a>
    </h5>

  </div>

{{-- ======IZBOR PROFILNE SLIKE, AKO POSTOJI========== --}}


  @if($product->images->count())
  <table class="col-12 mb-4">
    <tr class="row d-flex justify-content-center">
      <th class="col-6 mr-0 text-center pb-3">Slika</th>
      <th class='col-2 text-center pb-3'>Izaberi za profilnu</th>
    </tr>
  @foreach ($product->images as $image)
    <tr class="row d-flex justify-content-center align-items-center">
      <td class="col-6 imageToSelect py-3">
        <img src="/images/{{$image->name}}" alt="">
      </td>
      <td class="col-2 py-3">
        <input type="radio" name="image" value='{{$image->name}}' @if($product->image == $image->name) checked @endif>
      </td>

    </tr>
  @endforeach
</table>
  @else
    <div class="col-12 py-3"><h5 class="text-danger">Nema ubačenih slika za {{$product->name}}</h5></div>
    <input type="hidden" name="image" value='placeholder.png'>
  @endif


{{-- ======//IZBOR PROFILNE SLIKE, AKO POSTOJI========== --}}


</div>

@else

<div class="row my-3">
    <div class="col-12 pl-4">
    <multiple-input-files :name="'image'" :max-no-of-fields="1">
      <h4 slot='errorMsg' class='text-center'>
        Izaberite za sada jednu (profilnu) sliku, <br>
        po ubacivanju proizvoda moći ćete dodati još
      </h4>
    </multiple-input-files>
  </div>

</div>

@endedit





{{-- <div class="form-group">
  <label for="productImage"><h4><strong>
    @edit
    Promenite sliku proizvoda
    @else
    Slika proizvoda (nije obavezno)
    @endedit
  </strong></h4></label>
  <input type="file" class="form-control-file" id="productImage" name="image">
</div>

<hr class='my-2'> --}}
