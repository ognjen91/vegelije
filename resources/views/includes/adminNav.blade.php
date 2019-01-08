<div class="col-12 px-1">

  @if(\Route::currentRouteName() !== 'home')<a href="{{route('home')}}" class="btn btn-light m-2">Dashboard</a>@endif


  @if(\Route::currentRouteName() == 'products')
    <a href="{{route('trashedProducts')}}" class="btn btn-danger m-2"><i class="far fa-trash-alt"></i> Obrisani konkretni proizvodi</a>
  @elseif(\Route::currentRouteName() == 'productGroups')
    <a href="{{route('trashedProductGroups')}}" class="btn btn-danger m-2"><i class="far fa-trash-alt"></i> Obrisane grupe proizvoda</a>
  @elseif(\Route::currentRouteName() == 'trashedProducts')
    <a href="{{route('products')}}" class="btn btn-primary m-2">Konkretni proizvodi</a>
  @elseif(\Route::currentRouteName() == 'trashedProductGroups')
    <a href="{{route('productGroups')}}" class="btn btn-primary m-2">Grupe proizvoda</a>
  @else
  @endif

  @if(isset($product))
      @edit
      @if(!$product->deleted_at)
        @if($product->manufacturer_id)
          <a href="{{route('products', $product->name[0])}}" class="btn btn-danger m-2"><i class="far fa-trash-alt"></i> Konkretni proizvodi</a>
        @else
          <a href="{{route('productGroups', $product->name[0])}}" class="btn btn-danger m-2"><i class="far fa-trash-alt"></i> Grupe proizvoda</a>
        @endif
      @else
        @if($product->manufacturer_id)
          <a href="{{route('trashedProducts', $product->name[0])}}" class="btn btn-danger m-2"><i class="far fa-trash-alt"></i> Obrisani konkretni proizvodi</a>
        @else
          <a href="{{route('trashedProductGroups', $product->name[0])}}" class="btn btn-danger m-2"><i class="far fa-trash-alt"></i> Obrisane grupe proizvoda</a>
        @endif
      @endif
      @endedit
  @endif


  <a href="{{route('newProduct')}}" class="btn btn-success btn-lg mr-5 float-lg-right "><i class="fas fa-plus-circle"></i> Dodajte proizvod</a>


</div>
