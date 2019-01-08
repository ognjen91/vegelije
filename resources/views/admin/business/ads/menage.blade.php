@extends('layouts.admin')

@section('content')

<div class="col-10 offset-1 col-md-8 offset-md-2 mb-4">
  <h1 class='pl-4 underlined'><strong>{{ $serbianNameOfType }} {{$imageableObject->name}} : slike</strong></h1>
</div>


{{-- ========POSTOJECE SLIKE================== --}}
<div class="col-10 offset-1 col-md-8 offset-md-2 mb-5 pl-4">
  <div class="row">
  @if($imageableObject->images->count())
    <h4 class='pl-4 mb-5 c2'><strong>Postojeće slike</strong></h4>
  <table class="col-12">
    <tr class='row'>
      <th class="col-3 text-center">Slika</th>
      <th class='col-2 text-center'>Obriši</th>
    </tr>
  @foreach ($imageableObject->images as $image)
    <tr class='row'>
      <td class="col-3 imageableImage py-2">
          <img src="/images/{{$image->name}}" alt="">
      </td>
      <td class="col-2 py-2 d-flex justify-content-center align-items-center">
          <icon-warning-and-action :url="'{{route('deleteImage', $image->id)}}'" :target-item-name="'ovu sliku'" :icon='"far fa-trash-alt"' :method="'delete'">
          <p slot="msg">
          Da li ste sigurni da želite da obrišete
          </p>
         </icon-warning-and-action>
     </td>

    </tr>
  @endforeach
</table>
  @else
    <h4 class='pl-4 mb-5'><strong>{{ $serbianNameOfType }} {{$imageableObject->name}} : nema dodatih slika</strong></h4>
  @endif
  </div>
</div>




{{-- =========DODAVANJE NOVIH SLIKA, AKO IMA MANJE OD 4=========== --}}
@if($imageableObject->images->count() < 4)

  <div class="col-10 offset-1 col-md-8 offset-md-2 pl-4 mb-4">
    <h2 class='pl-4 underlined'><strong>{{ $serbianNameOfType }} {{$imageableObject->name}} : dodajte nove slike </strong></h2>
  </div>

<form action="{{route('storeImages')}}" method="post" enctype="multipart/form-data" class="col-10 offset-1 col-md-8 pt-3">
@csrf
{{-- ========DODAVANJE NOVIH============ --}}
<div class="col-12 col-md-8 offset-md-2 mb-2">

      <multiple-input-files :name="'images'" :max-no-of-fields="{{$maxNoOfImages - $imageableObject->images->count()}}" :must-upload-multiple=true>
        <h4 slot='errorMsg' class='text-center'>{{ $serbianNameOfType }} {{$imageableObject->name}} : mogu se ubaciti maksimalno {{$maxNoOfImages}} slike</h4>
      </multiple-input-files>

</div>

<input type="hidden" name='imageable_type' value="{{$imageable_type}}">
<input type="hidden" name='id' value="{{$imageableObject->id}}">

<div class=" offset-md-2 pl-4 mt-5">
  <input class="btn btn-primarty vegelijeButton mtn-block btn-lg" type="submit" value="Ubaci slike!">
</div>

</form>

@else
  <div class="col-10 offset-1 col-md-8 offset-md-2 pl-4 mb-4">
    <h3 class='pl-4'>
      Ubačen je maksimalni broj slika za {{$imageableObject->name}} ({{$maxNoOfImages}} {{$maxNoOfImages%10 == 1? 'slika' : 'slike'}}). <br>
      Da bi dodali nove slike, prvo izbrišite neke od postojećih.
    </h3>
  </div>
@endif






@endsection
