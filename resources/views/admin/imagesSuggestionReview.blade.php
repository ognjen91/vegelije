@extends('layouts.admin')

@section('content')

<form class="col-12 suggestedImgs" action="{{route('proceedImagesSuggestion', $suggestion->id)}}" method="post">
  {{-- {{dd($suggestion->images)}} --}}
 @csrf
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
@endif

<input type="submit" class="btn btn-primary btn-block btn-lg vegelijeButton" value="Obradi predlog">
</form>



@endsection
