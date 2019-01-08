<div class="row my-5">
<div class="col-12">
  <h4 class="c2">Izbor profilne slike</h4>
</div>
</div>

@edit
<div class="row my-3">
  <div class="col-12">
    @if($manufacturer->image == 'placeholder.png')
      <h4 class="mb-2" >Profilna slika proizvoda nije odabrana i dok je ne odaberete,
        prikazivaće se default slika
      </h4>
    @endif
    <h5 class="mb-5">Dodajte nove slike proizvođača ili izbrišite stare
      <a href="{{route('editImages', ["Manufacturer", $manufacturer->id])}}" class="c2Link">
      OVDJE
      </a>
    </h5>

  </div>

{{-- ======IZBOR PROFILNE SLIKE, AKO POSTOJI========== --}}


  @if($manufacturer->images->count())
  <table class="col-12 mb-4">
    <tr class="row d-flex justify-content-center">
      <th class="col-6 mr-0 text-center pb-3">Slika</th>
      <th class='col-2 text-center pb-3'>Izaberi za profilnu</th>
    </tr>
  @foreach ($manufacturer->images as $image)
    <tr class="row d-flex justify-content-center align-items-center">
      <td class="col-6 imageToSelect py-3">
        <img src="/images/{{$image->name}}" alt="">
      </td>
      <td class="col-2 py-3">
        <input type="radio" name="image" value='{{$image->name}}' @if($manufacturer->image == $image->name) checked @endif>
      </td>

    </tr>
  @endforeach
</table>
  @else
    <div class="col-12 py-3"><h5 class="text-danger">Nema ubačenih slika za {{$manufacturer->name}}</h5></div>
  @endif


{{-- ======//IZBOR PROFILNE SLIKE, AKO POSTOJI========== --}}


</div>

@else

<div class="row my-3">
    <div class="col-12 pl-4">
    <multiple-input-files :name="'image'" :max-no-of-fields="1">
      <h4 slot='errorMsg' class='text-center'>
        Izaberite za sada jednu (profilnu) sliku, <br>
        po ubacivanju proizvođača moći ćete dodati još
      </h4>
    </multiple-input-files>
  </div>

</div>

@endedit
