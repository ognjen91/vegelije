@extends('layouts.admin')

@section('content')

<div class="col-10 offset-1 col-md-8 offset-md-2">

  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

{{-- {{dd($suggestion->deleted_at)}} --}}
  <suggestion-form-with-custom-action :suggestion-id="{{$suggestion->id}}" :already-deleted="{{$suggestion->deleted_at? 1:0}}">
  {{-- <suggestion-form-with-custom-action :suggestion-id="{{$suggestion->id}}"> --}}
    <div slot='token'>@csrf</div>
{{-- {{dd($suggestion)}} --}}


        @if(count($similars))
        <div slot='similars' class="d-flex flex-column my-3">
          <h5 class="c1"><strong>Sa sličnim imenom</strong></h5>

          @foreach ($similars as $similar)
          <a href="{{isset($similar->manufacturer_id)? route('editProduct', $similar->id) : route('editProductGroup', $similar->id)}}">
            {{isset($similar->manufacturer_id)? 'Proizvod' : 'Grupa proizvoda'}} {{$similar->name}}</a>
          @endforeach
        </div>
        @endif



      <div slot='defaults'>
        @if($suggestion->suggestedBy)
        <input type="hidden" name="suggestedBy" value="{{$suggestion->suggestedBy}}">
        <h3 class="c2 mb-4">Predložio posetilac {{$suggestion->suggestedBy}}</h3>
        @else
        <h3 class="c2 mb-4">Predložio anonimni posetilac</h3>
        @endif


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


      <template slot="category">
        {{-- kategorija proizvoda --}}
       <custom-select :id='"productCategory"' :name="'category_id'" :all="{{$categories}}"
       @errors
       :old-value="`{{old('category_id')}}`"
       @else
       :old-value="'1'"
       @enderrors>
       <template slot='selectTitle'>Kategorija proizvoda</template>
       </custom-select>
      </template>


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
      <h5 class="fo1">Proizvođača nema na spsiku? <a href="{{route('createManufacturer')}}">Dodajte ga ovde</a></h5>
      </div>

      {{-- veganski/vegeterijanski/ni1ni2 --}}
      <template slot="isVege">
        @include('admin.suggestionReview.productLegality')
      </template>


      {{-- slika proizvoda/grupe proizvoda --}}
      @if($suggestion->images->count())
      <h4 class="mb-4"><strong>Predložene slike proizvoda</strong></h4>
      @foreach ($suggestion->images as $image)
        <div slot="image" class="my-4">
          <suggested-image :image="'{{$image->name}}'" :name="'images'" :accepted-image-field-name="'imagesAcceptedNames[]'"  :rejected-image-field-name="'imagesRejectedNames[]'">
            <template slot="acceptMsg">Prihvatam ovu sliku proizvoda</template>
            <template slot="setProfile">Želim da ova slika bude profilna</template>
            <template slot="notAcceptMsg">Ne prihvatam ovu sliku proizvoda</template>
            <template slot="uploadOtherImgMsg">Odaberite drugu sliku <small>(nije obavezno)</small></template>
          </suggested-image>
        </div>
      @endforeach
      @else
        <h4 class=""><strong>Korisnik nije poslao slike proizvoda uz predlog</strong></h4>
        <h5 class="mb-4">Ukoliko želite, ubacite sliku sada, ili možete to učiniti naknadno</h5>

        <multiple-input-files :name="'image'" :max-no-of-fields="1">
          <h4 slot='errorMsg' class='text-center'>
            Izaberite za sada jednu (profilnu) sliku, <br>
            po ubacivanju proizvoda moći ćete dodati još
          </h4>
        </multiple-input-files>
      @endif



        <div slot='selectGroups' class="my-4">
          @include('admin.createOrEdit.selectProductGroups')
        </div>

        <div slot='tags'>
          <add-tags  @errors :old-value="'{{ old('tags') }}'"
                     @else
                     :old-value="'{{$suggestion->tags}}'"
                     @enderrors>
          </add-tags>



            @admin
              <div slot=additional class='row my-5'>
                <a href="{{route('editImages', ['Suggestion', $suggestion->id])}}" class="btn btn-primary btn-block btn-lg">
                  Menadžer slika za ovaj prijedlog
                </a>
            </div>
            @endadmin



        </div>


  </suggestion-form-with-custom-action>


</div>




@endsection
