@extends('layouts.admin')

@section('content')

  <form action="{{route('deleteImages')}}" method="post">
    @csrf
  <div class="col-12">
    @if(count($imagesOnPage))
    @foreach ($imagesOnPage as $imgToDel)
    <div class="row imageOnPage py-1 d-flex align-items-center">
      <div class="col-6 col-md-4  imgToDel mb-3 mb-md-4 mb-lg-5">
        <img src="/images/{{$imgToDel}}" alt="">
      </div>
      <div class="col-1 d-flex justify-content-center">
        <input type="checkbox" name='toDelete[]' value='{{$imgToDel}}'>
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

<div class="form-group row">
  <div class="offset-sm-1 col-sm-10">
    <button type="submit" class="btn btn-primary btn-block btn-lg c1Button">Obriši označene</button>
  </div>
</div>

</form>






@endsection
