<div class="row ">
 @if($product->image !== 'placeholder.png')
   <div class="{{isset($product->declarationImage) && $product->declarationImage? "col-6" : "col-12"}}">
      <div class="row">
          <div class="col-12">
            <h5 class="c5 text-center mb-2">Slika proizvoda</h5>
            <h6 class="c5 text-center mb-2">(klik za prikaz)</h6>
          </div>
          <div class="col-12 col-md-8 offset-md-2 productImage">
            <zoomable-image :image-src="'/images/{{$product->image}}'"></zoomable-image>
          </div>
      </div>
   </div>
 @endif
 @if(isset($product->manufacturer_id))
   @if($product->declarationImage)
     <div class="{{$product->image !== 'placeholder.png'? "col-6" : "col-12"}}">
        <div class="row">
            <div class="col-12">
              <h5 class="c5 text-center mb-2">Slika deklaracije</h5>
              <h6 class="c5 text-center mb-2">(klik za prikaz)</h6>
            </div>
            <div class="col-12 col-md-8 offset-md-2 productImage">
              <zoomable-image :image-src="'/images/{{$product->declarationImage}}'"></zoomable-image>
            </div>
        </div>
     </div>
   @endif
 @endif
</div>
