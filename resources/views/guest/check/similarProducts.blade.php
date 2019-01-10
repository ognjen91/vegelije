
  <div class="row mb-1">

    <h5 class="w-100 c5 underlined text-center mb-2 mb-lg-3"><strong>Možda će vas zanimati i...</strong></h5>

  </div>
<div class="row  d-flex justify-content-center">
  @foreach ($similarProducts as $key => $similarProduct)
    @if($key<4)
      <div class="col-6 col-md-3">
        <h6 class="text-center c1 spaced"><strong>{{$similarProduct->name}}</strong></h6>
        <p class="text-center c4">{{$similarProduct->manufacturer->name}}</p>
        <a href="{{route('checkProduct', $similarProduct->id)}}" class="btn btn-primary btn-block  vegelijeButton2">
          Pogledaj
        </a>
      </div>
    @endif
  @endforeach
</div>
