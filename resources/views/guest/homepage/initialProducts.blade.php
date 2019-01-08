
{{-- {{dd($lastProducts)}} --}}

  {{-- POSLJEDNJI PROIZVODI --}}

<h2 class="fo2  py-2 mb-3 mt-lg-4 mb-lg-5 text-center spaced c1 initial">Poslednji ubačeni proizvodi i grupe</h2>
<div class="row mb-4 pl-lg-5 d-flex justify-content-center">
    @foreach ($lastProducts as $key=>$product)
        @include('guest.homepage.product')
    @endforeach
</div>


@if($mainAds->count())
<div class="row d-flex justify-content-center mb-2 mb-md-4">
<slide-in-view :class-of-div='"col-10 col-sm-8  initial"' :duration='1000'>
  <div slot="entering" class="row">
    <div class="col-12">
      @include('includes.ads.MainAdDown')
    </div>
  </div>
</slide-in-view>
</div>
@endif




@if(isset($recommendedProducts))
@if($recommendedProducts->count())
<h2 class="py-2 mb-3 mt-lg-4 mb-lg-5 text-center spaced c2 initial fo2">Ovog meseca <span class="c1 fo2">Vegelije</span> preporučuju</h2>
<div class="row mb-4 pl-lg-5 d-flex justify-content-center homepageRecommended">
    @foreach ($recommendedProducts as $key=>$product)
        @include('guest.homepage.product')
    @endforeach
</div>
@endif
@endif


  {{-- NASUMICNI PROIZVODI --}}

<h2 class="fo2  py-2 mb-3 text-center spaced c1 initial">Nasumično izabrani proizvodi</h2>
<div class="row mb-4 pl-lg-5 d-flex justify-content-center">
    @foreach ($randomProducts as $key=>$product)
      @include('guest.homepage.product')
    @endforeach
</div>
