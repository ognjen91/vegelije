@extends('layouts.app')

@section('content')

<div class="col-10 offset-1 col-md-8 offset-md-1">

<div class="row">
  <h2 class='c1 text-center'><strong>Admin: </strong>Kreiranje glavne reklame</h2>
</div>

<div class="row">

<form class='w-100' action="{{route('storeMainAd')}}" method='post' enctype="multipart/form-data">
  @csrf

  <div class="form-group mb-2 mb-md-3">
    <label for="naziv">Naziv reklame</label>
    <input required @errors value="{{old('name')}}"   @enderrors type="text" name="name" class="form-control" id="naziv" placeholder="Bilo šta...">
  </div>


<div class="form-group mb-2 mb-md-3">
  <label for="link">Link</label>
  <input required  type="text" @errors value="{{old('link')}}"   @enderrors name="link" class="form-control" id="link" placeholder="Bilo šta...">
</div>


<div class="form-group mb-2 mb-md-3">
  <label for="trajanje">Trajanje</label>
  <input required  type="number"  min="1" max="10" name="intervalInSeconds" @errors value="{{old('intervalInSeconds')}}"  @enderrors class="form-control" id="trajanje" placeholder="Broj u sekundama...">
</div>

  <div class="form-group">
    <label for="popupSlika">Popup Slika</label>
    <input type="file" name="popupImage" class="form-control-file" id="popupSlika">
  </div>

  <div class="form-group">
    <label for="donjaSlika">Slika za donji dio stranice</label>
    <input type="file" name="downImage" class="form-control-file" id="donjaSlika">
  </div>

  <input type="submit" value="Uskladišti" class='btn btn-primary btn-block btn-lg vegelijeButton'>

</form>
</div>


</div>






@endsection
