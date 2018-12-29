
{{-- {{dd($lastProducts)}} --}}

  {{-- POSLJEDNJI PROIZVODI --}}

<h2 class="py-2 mb-3 mt-lg-4 mb-lg-5 text-center spaced c1 initial">Poslednji ubačeni proizvodi</h2>
<div class="row mb-4 pl-lg-5 d-flex justify-content-center">
    @foreach ($lastProducts as $product)
        @include('guest.homepage.product')
    @endforeach
</div>



  {{-- NASUMICNI PROIZVODI --}}

<h2 class="py-2 mb-3 text-center spaced c1 initial">Nasumično izabrani proizvodi</h2>
<div class="row mb-4 pl-lg-5 d-flex justify-content-center">
    @foreach ($randomProducts as $product)
      @include('guest.homepage.product')
    @endforeach
</div>
