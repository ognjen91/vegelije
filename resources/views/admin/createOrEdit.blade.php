@extends('layouts.admin')

@section('content')
{{-- {{dd(get_class($product))}} --}}


{{-- vracanje iz obrisanih --}}

<div class="col-10 offset-1 col-md-8 offset-md-2">


@edit
@if($product->deleted_at)
<div class="col-12 my-4">
<button-warning-and-action :url="'{{$product->manufacturer_id? route('restoreProduct', $product->id) : route('restoreProductGroup', $product->id)}}'" :target-item-name="'{{$product->name}}'" :button='"btn btn-success  btn-lg btn-block"' :method="'post'">
    <p slot='buttonText'>Vrati iz obrisanih!</p>
    <template slot='token'>@csrf</template>
    <p slot="msg">
      Da li ste sigurni da želite da vratite iz obrisanih
    </p>
</button-warning-and-action>
</div>
@endif
@endedit

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

{{-- ======================FORMA==================================================== --}}
{{-- forma koja sama mijenja sadrzaj, action i td --}}
<product-form-with-custom-action @edit :edit='true'   @endedit @if(isset($product)) @if($product->deleted_at) :disable-form="true" @else :disable-form="false" @endif @endif>
  <template slot='token'>@csrf</template>


  {{-- default unosi, koji postoje i za tacan proizvod i za grupu proizvoda --}}
  <div slot="defaults">

  @edit
    <div class="col-12 alert alert-info">

      @if($product->fromSuggestion)
        <h4 class="fo1">Ovaj proizvod je dodat iz sugestije @if($product->suggestedBy) posetioca {{$product->suggestedBy}} @endif</h4>
        <h4 class="fo1">Odobrio {{$product->user->name}}</h4>
      @else
        <h4 class="fo1">Dodao {{$product->user->name}}</h4>
      @endif

      @if($product->deleted_at)
         <h4>Obrisano {{$product->deleted_at->format('d.m.Y')}}</h4>
      @endif
    </div>
  @endedit


      {{-- izbor da li je proizvod ili grupa proizvoda --}}
      {{-- iz ove komponente potice logika rute --}}
      <product-or-product-group class='@if(isset($product)) disabledField invisible @else my-4 p-2  @endif '
      @create
      :editing="false"
      @errors :product-or-product-group="`{{old('productOrProductGroup')}}`" @else :product-or-product-group="'product'" @enderrors
      @else
      :editing="true" :product-id="'{{$product->id}}'"
      @errors
      :product-or-product-group="`{{old('productOrProductGroup')}}`"
      @else
      :product-or-product-group="@if(isset($product->manufacturer_id)) 'product' @else 'productGroup' @endif"
      @enderrors
      @endcreate>
      </product-or-product-group>



      {{-- ime proizvoda --}}
      <custom-input :id="'productName'" :name="'name'" :type="'text'"  :required="true" class="my-3"
      @errors
      :old-value="`{{old('name')}}`"
      @else
      @edit :old-value="'{{$product->name}}'" @endedit
      @enderrors>
      <template slot='inputTitle'><strong>Naziv @edit{{isset($product->manufacturer_id)? "proizvoda" : "grupe proizvoda"}}@endedit</strong></template>
      </custom-input>


       {{-- kategorija proizvoda --}}
      <div slot='category'>
        @include('admin.createOrEdit.category')
      </div >


  </div>

  {{-- veganski/vegeterijanski/ni1ni2 --}}
  <template slot="isVege">
    @include('admin.createOrEdit.productLegality')
  </template>


    {{-- komentar --}}
    <div slot="commentEditor" class="my-4">
    <h4><strong>Komentar</strong></h4>
    <textarea name="description" class="form-control productDescription w-100">
      @errors
      {{old('description')}}
      @else
      @edit {{$product->description}} @endedit
      @enderrors
    </textarea>
    @include('admin.createOrEdit.editorSettings')
    </div>


    {{-- proizvodjac, za konkretan proizvod --}}
    <div slot="manufacturer">
    <custom-select :id='"productManufacturer"' :name="'manufacturer_id'" :all="{{$manufacturers}}"
     @errors :old-value="`{{old('manufacturer_id')}}`"
     @else
     @edit :old-value="'{{$product->manufacturer_id}}'" @endedit
     @enderrors>
    <template slot='selectTitle'>Proizvođač</template>
    </custom-select>
    <p class='fo1'>Proizvođača nema na listi? <a href="{{route('createManufacturer')}}">Dodajte ga</a></p>
    </div>


    {{-- slika proizvoda/grupe proizvoda --}}
    <div slot="image" class="my-4">
      @include('admin.createOrEdit.images.image')
    </div>


  {{-- ako je u pitanju konkretan proizvod, izbor grupa --}}
  <div slot='selectGroups' class="my-4">
    @include('admin.createOrEdit.selectProductGroups')
  </div>



{{-- {{dd($tags)}} --}}
   {{-- tagovi --}}
  <div slot='tags'>
    <add-tags  @errors :old-value="'{{ old('tags') }}'"
               @else
               @edit :old-value="'{{$tags}}'" @endedit
               @enderrors>
    </add-tags>
  </div>


{{-- ===========DA LI JE PROIZVOD PREPROUCEN======== --}}
@include('admin.createOrEdit.isRecommended')



</product-form-with-custom-action>

@edit
{{-- dodatno, duge za brisanje/vracanje --}}

<div class="col-12">
@if(!$product->deleted_at)
  <button-warning-and-action :url="'{{$product->manufacturer_id? route('deleteProduct', $product->id) : route('deleteProductGroup', $product->id)}}'" :target-item-name="'{{$product->name}}'" :button='"btn btn-danger btn-lg btn-block"' :method="'delete'">
    <p slot='buttonText'>Obriši!</p>
    <template slot='token'>@csrf</template>
    <p slot="msg">
      Da li ste sigurni da želite da obrišete
    </p>
  </button-warning-and-action>
@endif


{{-- dodanto, prijedlozi za promjenu slika --}}
@if(isset($product->manufacturer_id))
  @include('admin.createOrEdit.listProductSuggestions')
@else
  @include('admin.createOrEdit.listProductGroupSuggestions')
    {{-- ++za grupe proizvoda izlistavanje proizvoda koji pripadaju grupi --}}
  @if($product->products->count())
    <h2 class="my-3 text-center c2">Proizvodi povezani sa ovom grupom proizvoda</h2>
  <listing-products-and-product-groups :products="{{$product->products()->with('category', 'manufacturer')->get()}}"></listing-products-and-product-groups>
    @else
      <h2 class="my-3 text-center c2">Nema konkretnih proizvoda povezanih sa ovom grupom proizvoda!</h2>
   @endif

@endif


@endedit
</div>


</div>


@endsection
