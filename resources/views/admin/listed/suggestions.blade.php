@extends('layouts.admin')
@section('adminTitle', 'Predlozi korsnika')

@section('content')

  <div class="col-12">
    @trashed
      <a href="{{route('suggestions')}}" class="btn btn-danger m-2">Neobrađeni predlozi</a>
    @else
      <a href="{{route('trashedSuggestions')}}" class="btn btn-success m-2"><i class="far fa-trash-alt"></i> Odbačeni predlozi</a>
    @endtrashed
  </div>


  @if($products->count())
  <div class="col-12 col-md-8 offset-md-2">

<table class="listingTable w-100">
  <tr>
    <th>Naziv</th>
    <th>Datum</th>
    <th>Pregledaj</th>
    @trashed

    @else
    <th>Odbaci</th>
    @endtrashed
  </tr>
  @foreach ($products as $product)
  <tr>
    <td class='suggestedItem'>{{$product->name}}</td>
    <td>{{$product->created_at->format('d.m.Y') }}</td>
    <td><a href="{{route('suggestionReview', $product->id)}}"><i class="far fa-eye"></i></i></a></td>
    @trashed

    @else
    <td>
      <icon-warning-and-action :url="'{{route('deleteSuggestion', $product->id)}}'" :target-item-name="'{{$product->name}}'" :icon='"fas fa-trash trashCan"' :method="'delete'">
        <p slot="msg">
        Da li ste sigurni da želite da odbacite predlog
        </p>
       </icon-warning-and-action>
    </td>
    @endtrashed
  </tr>
  @endforeach
</table>

</div>

<div class="col-10 offset-1 col-md-8 offset-md-2 my-4 pagination">
{{$products->links()}}
</div>

@else
<div class="col-10 offset-1 col-md-8 offset-md-2 mb-5">
  <h2>Nema ni jednog predloženog proizvoda. <a href="{{route('newProduct')}}">Ubacite novi proizvod</a>
</div>
@endif


@endsection
