@extends('layouts.admin')

@section('content')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

<form  class="col-10 offset-1 col-md-8 offset-md-2 my-4" action="@edit{{route('updateManufacturer', $manufacturer->id)}}@else{{route('storeManufacturer')}}@endedit" method="post" enctype="multipart/form-data">
@csrf
@edit {{method_field('PATCH')}} @endedit

<custom-input :id="'manufacturerName'" :name="'name'" :type="'text'"  :required="true" class="my-3"
@errors
:old-value="`{{old('name')}}`"
@else
@edit :old-value="'{{$manufacturer->name}}'" @endedit
@enderrors>
<template slot='inputTitle'><strong>Naziv proizvođača</strong></template>
</custom-input>

<div class="mb-2">
<h4 class="mb-2"><strong>Opisni tekst</strong></h4>
<textarea name="description" class="form-control productDescription w-100 mb-2">
      @errors
      {{old('description')}}
      @else
      @edit {{$manufacturer->description}} @endedit
      @enderrors
    </textarea>
    @include('admin.createOrEdit.editorSettings')
</div>

{{-- slika proizvođača --}}
<div slot="image" class="my-4">
  @include('admin.createOrEdit.images.manufacturerImage')
</div>

  <input type="submit" value='Prihvati' class='btn btn-success btn-lg btn-block mb-5'>

</form>

@edit
<div class="col-12 my-4">
      @if(!$manufacturer->deleted_at)
        <button-warning-and-action :url="'{{route('deleteManufacturer', $manufacturer->id)}}'" :target-item-name="'{{$manufacturer->name}}'" :button='"btn btn-danger btn-lg btn-block"' :method="'delete'">
          <p slot='buttonText'>Obriši!</p>
          <template slot='token'>@csrf</template>
          <p slot="msg">
            Da li ste sigurni da želite da obrišete proizvođača
          </p>
        </button-warning-and-action>
      @else
      <div class="col-12 my-4">
      <button-warning-and-action :url="'{{route('restoreManufacturer', $manufacturer->id)}}'" :target-item-name="'{{$manufacturer->name}}'" :button='"btn btn-success  btn-lg btn-block"' :method="'post'">
          <p slot='buttonText'>Vrati iz obrisanih!</p>
          <template slot='token'>@csrf</template>
          <p slot="msg">
            Da li ste sigurni da želite da vratite iz obrisanih proizvođača
          </p>
      </button-warning-and-action>
      </div>
      @endif
</div>
@endedit


@endsection
