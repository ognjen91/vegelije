@extends('layouts.app')

@section('content')

<form  class="w-100 my-4" action="@edit {{route('updateManufacturer', $manufacturer->id)}} @else {{route('storeManufacturer')}}@endedit" method="post">
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

  <input type="submit" value='Prihvati' class='btn btn-success btn-lg btn-block'>

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
