@trashed

<div class="col-12 py-5">
  <a href="{{route('trashedProducts', $letter)}}" class="btn btn-danger my-2"><i class="far fa-trash-alt"></i> Obrisani Konkretni proizvodi</a>
  <a href="{{route('trashedProductGroups', $letter)}}" class="btn btn-danger my-2"><i class="far fa-trash-alt"></i> Obrisane Grupe proizvoda</a>
</div>

@else

<div class="col-12 py-5">
  <a href="{{route('products', $letter)}}" class="btn btn-primary my-2">Konkretni proizvodi</a>
  <a href="{{route('productGroups', $letter)}}" class="btn btn-primary my-2">Grupe proizvoda</a>
</div>

@endtrashed
