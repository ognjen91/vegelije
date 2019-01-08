@extends('layouts.admin')

@section('content')

<div class="col-10 offset-1 col-md-8 offset-md-1">

<div class="row">
  <h2 class='c1 text-center'><strong>Admin: </strong>Kreiranje sporedne reklame</h2>
</div>

<div class="row">

<form class='w-100' action="{{route('storeSecondAd')}}" method='post' enctype="multipart/form-data">
  @csrf

  <div class="form-group mb-2 mb-md-3">
    <label for="naziv">Naziv reklame</label>
    <input required @errors value="{{old('name')}}"   @enderrors type="text" name="name" class="form-control" id="naziv" placeholder="Bilo šta...">
  </div>


<div class="form-group mb-2 mb-md-3">
  <label for="link">Link</label>
  <input required  type="text" @errors value="{{old('link')}}"   @enderrors name="link" class="form-control" id="link" placeholder="Bilo šta...">
</div>



  <div class="form-group">
    <label for="saStraneSlika">"Side" Slika</label>
    <input type="file" name="sideImage" class="form-control-file" id="saStraneSlika">
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
