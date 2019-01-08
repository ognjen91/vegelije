@extends('layouts.admin')

@section('content')

<div class="col-10 offset-1 col-md-8 offset-md-1">

<div class="row">
  <div class="col-12">
  <h2 class='c1 text-center d-block'><strong>Admin: </strong>Izmjena glavne reklame {{$mainAd->name}} </h2> <br>
  <h4 class='c1 text-center d-block'>Obriši ovu reklamu  <icon-warning-and-action class="d-inline" :url="'{{route('deleteMainAd', $mainAd->id)}}'" :target-item-name="'{{$mainAd->name}}'" :icon='"fas fa-trash trashCan"' :method="'delete'">
    <p slot="msg">
    Da li ste sigurni da želite da obrišete
    </p>
   </icon-warning-and-action>
 </h4>
</div>
</div>

<div class="row">

<form class='w-100' action="{{route('updateMainAd', $mainAd->id)}}" method='post'>
  @csrf

  <div class="form-group mb-2 mb-md-3">
    <label for="naziv">Naziv reklame</label>
    <input required @errors value="{{old('name')}}" @else value="{{$mainAd->name}}"  @enderrors type="text" name="name" class="form-control" id="naziv" placeholder="Bilo šta...">
  </div>


<div class="form-group mb-2 mb-md-3">
  <label for="link">Link</label>
  <input required  type="text" @errors value="{{old('link')}}" @else value="{{$mainAd->link}}"  @enderrors name="link" class="form-control" id="link" placeholder="Bilo šta...">
</div>


<div class="form-group mb-2 mb-md-3">
  <label for="trajanje">Trajanje Pop-upa</label>
  <input required  type="number"  min="1" max="10" name="intervalInSeconds" @errors value="{{old('intervalInSeconds')}}" @else value="{{$mainAd->intervalInSeconds}}" @enderrors class="form-control" id="trajanje" placeholder="Broj u sekundama...">
</div>
  <table>
    <tr>
      <th class="w-50 "></th>
      <th class="w-20 ">Popup</th>
      <th class="w-20 ">Down</th>
    </tr>
    @foreach($mainAd->images as $img)
    <tr>
      <td class='imgToAd w-50 py-2'><img src="/images/{{$img->name}}" alt=""></td>
      <td class='w-20 py-2 d-inlin-flex justify-content-center'><input type="radio" name="popupImage" value="{{$img->name}}" @if($mainAd->popupImage == $img->name) checked @endif></td>
      <td class='w-20 py-2 d-inlin-flex justify-content-center'><input type="radio" name="downImage" value="{{$img->name}}" @if($mainAd->downImage == $img->name) checked @endif></td>
    </tr>
    @endforeach
  </table>

  <h2 class='text-center c1 my-5'>Mendadžer slika za ovu reklamu je <a href="{{route('editImages', ['MainAd', $mainAd->id])}}" class="c1Link"><strong class="underlined">Ovdje</strong></a></h2>
  <h5 class='text-center c1 my-5'>Pazi, ako se izbrise izabrana slika, mora se izabrati druga!!!</h5>

  <input type="submit" value="Promjeni" class='btn btn-primary btn-block btn-lg vegelijeButton'>

</form>
</div>


</div>






@endsection
