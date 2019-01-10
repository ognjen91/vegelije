
  <div class="row mb-3 mb-lg-4">

    <h5 class="w-100 c5 underlined text-center fo2"><strong class='fo2'>Vegelije</strong>preporučuju</h5>

  </div>
<div class="row  d-flex justify-content-center">
  @foreach ($recommendedProducts as $key => $recommendedProduct)
    @if($key<4)
      <div class="col-6 col-md-3">
        <h6 class="text-center c1 spaced"><strong>{{$recommendedProduct->name}}</strong></h6>
        <p class="text-center c4">{{$recommendedProduct->manufacturer->name}}</p>
        <a href="{{route('checkProduct', $recommendedProduct->id)}}" class="btn btn-primary btn-block  vegelijeButton2">
          Pogledaj
        </a>
      </div>
    @endif
  @endforeach
</div>
