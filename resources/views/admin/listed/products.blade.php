@extends('layouts.admin')
@section('adminTitle')
  @if(\Route::currentRouteName() == 'products')
  Konkretni proizvodi :
  @elseif(\Route::currentRouteName() == 'productGroups')
  Grupe proizvoda :
  @elseif(\Route::currentRouteName() == 'trashedProducts')
  Obrisani proizvodi :
@elseif(\Route::currentRouteName() == 'manufacturerProducts')
  Proizvodi proizvođača {{$manufacturer->name}} :
  @else
  Obrisane grupe proizvoda :
  @endif

  slovo {{strtoupper($letter)}}
@endsection

@section('content')

@include('includes.productsOrProductGroupsLinks')


<div class="col-10 offset-1 col-md-8 offset-md-2 alphabet mt-2 mb-4">
  @include('includes.alphabet')
</div>




  @if($products->total())
  <div class="col-12 col-md-8 offset-md-2">

<table class="listingTable w-100">
  <tr>
    <th>Naziv</th>
    @productsPage<th><a href="{{route('products',  ['letter'=>$letter, 'sort'=>'manufacturer_id'])}}">Proizvođač</a></th>@endproductsPage
    <th>Uredi</th>
    @trashed
    <th>Vrati</th>
    @else
    <th>Izbriši</th>
    @endtrashed
  </tr>
  @foreach ($products as $product)
  <tr>
    <td class={{$product->legal? "legalProduct" : "illegalProduct"}}>{{$product->name}}</td>
    {{-- <td>{{get_class($product)}}</td> --}}
    @productsPage <td>@if(isset($product->manufacturer)) <a href="{{route('manufacturerProducts', $product->manufacturer->id)}}">{{$product->manufacturer->name}}</a> @else / @endif</td> @endproductsPage
    <th><a href="{{$product->manufacturer_id? route('editProduct', $product->id) : route('editProductGroup', $product->id) }}"><i class="far fa-edit"></i></a></th>
    <td>
      @trashed
      <icon-warning-and-action :url="'{{$product->manufacturer_id? route('restoreProduct', $product->id) : route('restoreProductGroup', $product->id)}}'" :target-item-name="'{{$product->name}}'" :icon='"fas fa-recycle"' :method="'post'">
        <p slot="msg">
        Da li ste sigurni da želite da vratite iz obrisanih
        </p>
       </icon-warning-and-action>
      @else
      <icon-warning-and-action :url="'{{$product->manufacturer_id? route('deleteProduct', $product->id) : route('deleteProductGroup', $product->id)}}'" :target-item-name="'{{$product->name}}'" :icon='"fas fa-trash trashCan"' :method="'delete'">
        <p slot="msg">
        Da li ste sigurni da želite da obrišete
        </p>
       </icon-warning-and-action>
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
  <h2 class='text-center text-danger my-3 w-100'>Niste @trashed obrisali @else dodali @endtrashed ni jedan od ovih proizvoda čiji naziv počinje na  '{{$letter}}'</h2>
</div>
@endif

@endsection
