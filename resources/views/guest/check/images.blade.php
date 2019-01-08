@php
  $initialCount = $product->images->count();
  if(!isset($product->manufacturer_id) && !$initialCount){
    $product->images = collect([]);
    $counter = 0;
    while($product->images->count() < 3 && $counter<20){
      $imgs = $product->products()->inRandomOrder()->first()->images();
      if((!$imgs->count())) continue;
      if(!$product->images->contains($imgs->first())) $product->images[] = $imgs->first();
      $counter++;
    }
  }
@endphp



@if($product->images->count())
<div class="row">
        <div class="col-12">
                <h5 class="{{isset($product->manufactuer_id)? "c5" : "c1"}} text-center w-100 mb-md-4">
                  <strong>
                  {{$product->images->count()%10==1? "Slike" : "Slike"}} @if(!isset($product->manufacturer_id)){{$initialCount? 'grupe' : 'nekih od proizvoda iz ove grupe'}}  @endif proizvoda
                   <span class='d-none d-md-inline '>(klik za prikaz)</span>
                 </strong>
                 </h5>
                <h6 class="{{isset($product->manufactuer_id)? "c5" : "c1"}} text-center mb-2 w-100 d-md-none"><small>(klik za prikaz)</small></h6>

                <div class="row mt-2 mt-md-0 mx-md-2 mx-lg-3 ">
                  @foreach ($product->images as $image)
                    @switch($product->images->count())
                        @case(1)
                        <div class="1img col-8 offset-2 col-md-6 offset-md-3 mb-2 mb-md-3 productImgOnPage">
                          <zoomable-image :image-src="'/images/{{$image->name}}'"></zoomable-image>
                        </div>
                        @break
                        @case(2)
                        <div class="2imgs col-6 px-2 col-sm-6 px-md-4 col-md-6 px-md-4 col-lg-6 px-lg-4 productImgOnPage mb-3">
                          <zoomable-image :image-src="'/images/{{$image->name}}'"></zoomable-image>
                        </div>
                        @break
                        @case(3)
                        <div class="3imgs col-6 offset-3 col-md-4 offset-md-0 px-md-2  productImgOnPage mb-3">
                          <zoomable-image :image-src="'/images/{{$image->name}}'"></zoomable-image>
                        </div>
                        @break
                        @default
                        <div class="4imgs col-6 px-5 col-sm-6  col-md-6 px-md-4 col-lg-3 px-lg-2 productImgOnPage mb-3">
                          <zoomable-image :image-src="'/images/{{$image->name}}'"></zoomable-image>
                        </div>
                        @endswitch
                  @endforeach
               </div>

        </div>
</div>
@endif
{{--
<div class="row ">
 @if($product->image !== 'placeholder.png')
   <div class="{{isset($product->declarationImage) && $product->declarationImage? "col-6" : "col-12"}}">
      <div class="row">
          <div class="col-12">
            <h5 class="c5 text-center mb-2">Slika proizvoda</h5>
            <h6 class="c5 text-center mb-2">(klik za prikaz)</h6>
          </div>
          <div class="col-12 col-md-8 offset-md-2 productImgOnPage">
            <zoomable-image :image-src="'/images/{{$product->image}}'"></zoomable-image>
          </div>
      </div>
   </div>
 @endif
</div> --}}
