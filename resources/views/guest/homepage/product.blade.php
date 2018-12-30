<div class="product col-10   col-sm-8  col-lg-5 offset-lg-0 pt-2 pb-4 mr-lg-4 @if($key>5) d-none d-md-inline-block @endif">
  <div class="row">

    {{-- SLIKA PROIZVODA --}}
   <div class="productImage col-4 col-lg-5">
     <img src="/images/{{$product->image}}" alt="">
   </div>
   {{-- //SLIKA PROIZVODA --}}

   {{-- //INFO --}}
   <div class="col-8 col-lg-7 productQuickInfo ">
      <h4 class="mb-1 spaced px-1 text-center c2 c1-md w-100 mb-2">{{$product->name}}</h4>

     @if(isset($product->manufacturer))
        <a class=" fo1 mb-1 text-center  w-100 c2Link  mb-2" href="{{\Auth::check()? route('manufacturerProducts', $product->manufacturer->id) : route('manufacturerProductsGuest', $product->manufacturer->id)}}">
          <span>proizvodi </span>  <br class='d-md-none'><span class="underlined c2 c1-md">{{$product->manufacturer->name}}</span>
        </a>
     @else
       <a class=" fo1 mb-1 text-center  w-100 c2Link  mb-2" href="{{\Auth::check()? route('editProductGroup', $product->id) : route('checkProductGroup', $product->id)}}">
         <br class='d-md-none'><span class="underlined c2 c1-md">grupa proizvoda</span>
       </a>
     @endif

       <a class='fo1 mb-1 text-center  w-100 c2Link mb-2' href="{{route('categoryProducts', $product->category->name)}}">
         <span>u kategoriji </span><br class='d-md-none'> <span class="underlined c2 c1-md">{{$product->category->name}}</span>
       </a>

       <a   class="btn btn-primary rounded mt-2 px-2 vegelijeButton" href="{{isset($product->manufacturer)? route('checkProduct', $product->id) : route('checkProductGroup', $product->id)}}">
         Vege li je?
       </a>
   </div>
   {{-- //INFO --}}

   </div>
</div>
