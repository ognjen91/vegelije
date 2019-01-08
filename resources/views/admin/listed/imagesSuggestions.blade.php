@extends('layouts.admin')

@section('content')

<div class="col-10 offset-1 col-md-8 offset-md-1">
<table class='listingTable w-100'>
  <tr>
    <th>Datum</th>
    <th>Proizvod</th>
    <th>Pogledaj</th>
  </tr>
  @foreach ($imagesSuggestions as $suggestion)
    <tr>
        <td>{{$suggestion->created_at->format('d.m.Y.')}}</td>
        <td><a href="{{route('editProduct', $suggestion->product->id)}}">{{$suggestion->product->name}}</a></td>
        <td><a href="{{route('imagesSuggestionReview', $suggestion->id)}}"><i class="far fa-eye"></i></a></td>
    </tr>
  @endforeach
</table>
</div>










@endsection
