@if($productGroupEditSuggestions->total())
<div class="col-12   my-5">
<div class="row">
  <h5 class="text-center text-danger w-100 mb-2"><strong>Prijedlozi za promjenu podataka grupe proizvoda</strong></h5>
</div>
<div class="row">
  <table class="col-10 offset-1 col-md-8 offset-md-2 listingTable w-100">
    <tr>
      <th>Datum</th>
      <th>Pogledaj</th>
    </tr>
    @foreach($productGroupEditSuggestions as $suggestion)
    <tr>
      <td>{{$suggestion->created_at->format('d.m.Y.')}}</td>
      <td><a href="{{route('productGroupEditSuggestionReview', $suggestion->id)}}"><i class="far fa-eye"></a></td>
    </tr>
  @endforeach
  </table>
</div>
</div>
@endif

<div class="col-12 my-4 pagination">
  {{$productGroupEditSuggestions->links()}}
</div>
