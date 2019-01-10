@extends('layouts.admin')

@section('content')

  <form action="{{route('deleteImages')}}" method="post" class="w-100 row">
    @csrf
  <div class="col-12">
    @if(count($imagesOnPage['inImagesTable']) || count($imagesOnPage['notInImagesTable']) )
        @foreach (array_merge($imagesOnPage['inImagesTable'], $imagesOnPage['notInImagesTable']) as $imgToDel)
        <div class="row imageOnPage py-3 d-flex align-items-center justify-content-center {{in_array($imgToDel, $imagesOnPage['inImagesTable'])? 'inTable' : 'notInTable'}}">
          <div class="col-6 col-md-4  imgToDel">
            <img src="/images/{{$imgToDel}}" alt="">
          </div>
          <div class="col-1 d-flex justify-content-center">
            <input type="checkbox" name='toDelete[]' value='{{$imgToDel}}'>
          </div>
          <div class="col-5 col-md-7 d-flex align-items-center">
            <h5><strong>{{in_array($imgToDel, $imagesOnPage['inImagesTable'])? 'nalazi se u tabeli images' : 'ne nalazi se u tabeli images'}}</strong></h5>
          </div>
        </div>
        @endforeach
  @else
        <div class="col-12">
          <h5 class="text-center c2 w-100">Nema ništa na ovoj strani</h5>
        </div>
  @endif
  </div>

  <div class="col-12 pagination my-3">
    <div class="row d-flex flex-wrap">
    @for ($i=1; $i<=$pages; $i++)
      <a href="{{route('listImages', $i)}}" class="col-1 mr-1 mb-1 d-flex justify-content-center @if($i==$page)selectedPage @endif">
        {{$i}}
      </a>
    @endfor
  </div>
</div>

<div class="col-12">
<div class="form-group row">
  <div class="offset-sm-1 col-sm-10">
    <button type="submit" class="btn btn-primary btn-block btn-lg c1Button">Obriši označene</button>
  </div>
</div>
</div>


</form>






@endsection
