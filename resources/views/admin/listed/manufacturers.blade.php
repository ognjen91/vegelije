@extends('layouts.admin')
@section('adminTitle')
 @trashed Izbrisani proizvođači @else Proizvođači @endtrashed : slovo {{$letter}}
@endsection


@section('content')


<div class="col-12">
  @trashed
    <a href="{{route('manufacturers', $letter)}}" class="btn btn-success m-2">Proizvođači</a>
  @else
    <a href="{{route('trashedManufacturers', $letter)}}" class="btn btn-danger m-2"><i class="far fa-trash-alt"></i> Obrisani proizvođači</a>
  @endtrashed
  <a href="{{route('createManufacturer')}}" class="btn btn-success m-2"><i class="fas fa-plus-circle"></i> Dodajte novog proizvođača</a>
</div>



  <div class="col-10 offset-1 col-md-8 offset-md-2 alphabet mt-2 mb-4">
    @include('includes.alphabet')
  </div>




    @if($manufacturers->total())
    <div class="col-12 col-md-8 offset-md-2">

  <table class="listingTable w-100">
    <tr>
      <th>Naziv</th>
      <th>Uredi</th>
      <th>Vidi proizvode</th>
      @trashed
      <th>Vrati</th>
      @else
      <th>Izbriši</th>
      @endtrashed
    </tr>
    @foreach ($manufacturers as $manufacturer)
    <tr>
      <td>{{$manufacturer->name}}</td>
      <th><a href="{{route('editManufacturer', $manufacturer->id)}}"><i class="far fa-edit"></i></a></th>
      <th><a href="{{route('manufacturerProducts', $manufacturer->id)}}"><i class="far fa-eye"></i></a></th>
      <td>
        @trashed
        <icon-warning-and-action :url="'{{route('restoreManufacturer', $manufacturer->id)}}'" :target-item-name="'{{$manufacturer->name}}'" :icon='"fas fa-recycle"' :method="'post'">
          <p slot="msg">
          Da li ste sigurni da želite da vratite iz obrisanih proizvođača
          </p>
         </icon-warning-and-action>
        @else
        <icon-warning-and-action :url="'{{route('deleteManufacturer', $manufacturer->id)}}'" :target-item-name="'{{$manufacturer->name}}'" :icon='"fas fa-trash trashCan"' :method="'delete'">
          <p slot="msg">
          Da li ste sigurni da želite da obrišete proizvođača
          </p>
         </icon-warning-and-action>
        @endtrashed
    </tr>
    @endforeach
  </table>

  </div>

  <div class="col-12 my-4 pagination">
  {{$manufacturers->links()}}
  </div>

  @else
    <div class="col-10 offset-1 col-md-8 offset-md-2 mb-5">
    <h2 class='text-center text-danger my-3 w-100'>Niste @trashed obrisali @else dodali @endtrashed ni jednog proizvođača čiji naziv počinje na  '{{$letter}}'</h2>
    </div>
  @endif


@endsection
