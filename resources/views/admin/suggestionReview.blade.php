@extends('layouts.app')

@section('content')

<div class="col-10 offset-1 col-md-8 offset-md-2">

  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

{{-- {{dd($suggestion->deleted_at)}} --}}
  <suggestion-form-with-custom-action :suggestion-id="{{$suggestion->id}}" :already-deleted="{{$suggestion->deleted_at? 1:0}}">
  {{-- <suggestion-form-with-custom-action :suggestion-id="{{$suggestion->id}}"> --}}
    <div slot='token'>@csrf</div>

      <div slot='defaults'>

        <suggestion-product-or-product-group
        @errors
        :product-or-product-group="`{{old('productOrProductGroup')}}`"
        @else
        :product-or-product-group="'product'"
        @enderrors>
        </suggestion-product-or-product-group>

        {{-- ime proizvoda --}}
        <custom-input :id="'productName'" :name="'name'" :type="'text'"  :required="true" class="my-3"
        @errors
        :old-value="`{{old('name')}}`"
        @else
        :old-value="'{{$suggestion->name}}'"
        @enderrors>
        <template slot='inputTitle'>
           <strong>Naziv proizvoda: predloženo je <span style="color:red;">"{{$suggestion->name}}"</span></strong>
         </template>
        </custom-input>

        {{-- kategorija proizvoda --}}
       <custom-select :id='"productCategory"' :name="'category_id'" :all="{{$categories}}"
       @errors
       :old-value="`{{old('category_id')}}`"
       @else
       :old-value="'1'"
       @enderrors>
       <template slot='selectTitle'>Kategorija proizvoda</template>
       </custom-select>



        {{-- komentar --}}
        <div slot="commentEditor" class="my-4">
        <h4><strong>Komentar</strong></h4>
        <textarea name="description" class="form-control productDescription w-100">
          @errors
          {{old('description')}}
          @else
          {{$suggestion->description}}
          @enderrors
        </textarea>
        @include('admin.createOrEdit.editorSettings')
        </div>

      </div>


      {{-- proizvodjac, za konkretan proizvod --}}
      <div slot="manufacturer">
      <custom-select :id='"productManufacturer"' :name="'manufacturer_id'" :all="{{$manufacturers}}"
       @errors :old-value="`{{old('manufacturer_id')}}`"
       @else
       :old-value="'{{$suggestedManufacturerId}}'"
       @enderrors>
      <template slot='selectTitle'>Proizvođač - molimo izaberite sa spiska<br>
      Predložen je <span style="color:red;">{{$suggestion->manufacturer}}</span><br>
     </template>
      </custom-select>
      <h5 class="fo1">Proizvođača nema na spsiku? <a href="">Dodajte ga ovde</a></h5>
      </div>

      {{-- veganski/vegeterijanski/ni1ni2 --}}
      <template slot="isVege">
        @include('admin.createOrEdit.productLegality')
      </template>


      {{-- slika proizvoda/grupe proizvoda --}}
      <div slot="image" class="my-4">
        <suggested-image :image="'{{$suggestion->image}}'" :name="'image'" :acceptance-indicator-name="'imageAccepted'" :accepted-image-field-name="'imageAcceptedName'">
          <template slot="title">Slika proizvoda</template>
          <template slot="acceptMsg">Prihvatam ovu sliku proizvoda</template>
          <template slot="notAcceptMsg">Ne prihvatam ovu sliku proizvoda</template>
          <template slot="uploadOtherImgMsg">Odaberite drugu sliku <small>(nije obavezno)</small></template>
        </suggested-image>
      </div>
    {{-- slika deklaracije proizvoda, za konkretan proizvod --}}
      <div slot='declarationImage' class="my-4">
        <suggested-image :image="'{{$suggestion->declarationImage}}'" :name="'declarationImage'" :acceptance-indicator-name="'declarationImageAccepted'" :accepted-image-field-name="'declarationImageAcceptedName'">
          <template slot="title">Slika deklaracije proizvoda</template>
          <template slot="acceptMsg">Prihvatam ovu sliku deklaracije</template>
          <template slot="notAcceptMsg">Ne prihvatam ovu sliku deklaracije</template>
          <template slot="uploadOtherImgMsg">Odaberite drugu sliku deklaracije<small>(nije obavezno)</small></template>
        </suggested-image>      </div>


        <div slot='selectGroups' class="my-4">
          @include('admin.createOrEdit.selectProductGroups')
        </div>

        <div slot='tags'>
          <add-tags  @errors :old-value="'{{ old('tags') }}'"
                     @else
                     :old-value="'{{$suggestion->tags}}'"
                     @enderrors>
          </add-tags>
        </div>


  </suggestion-form-with-custom-action>


</div>




@endsection
