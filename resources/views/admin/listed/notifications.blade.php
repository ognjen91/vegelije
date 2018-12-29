@extends('layouts.app')
@section('adminTitle', 'Notifikacije')

@section('content')

  <div class="btn-group mb-5 notifDispatch col-12 flex-wrap" role="group" aria-label="Basic example">
    <a type="button" class="btn btn-success" href='{{route("notifications")}}'>Sve notifikacije [{{$noTotal}}]</a>
    <a type="button" class="btn {{$noOfUnseen? "btn-danger" : "btn-light"}}" href='{{route("unseenNotifications")}}'>Nepročitane [{{$noOfUnseen}}]</a>
    <a type="button" class="btn btn-secondary" href='{{route("seenNotifications")}}'>Pročitane [{{$noOfSeen}}]</a>
</div>


@if($notifications->total())
  <div class="col-12 col-md-8 offset-md-2">

<table class="listingTable w-100 fo1">
  <tr>
    <th>Datum</th>
    <th>Tekst</th>
    <th>Oznaci kao prоčitano/nepročitano</th>
  </tr>
  @foreach ($notifications as $notification)
    <tr class="{{$notification->read_at? 'readNotif' : 'unreadNotif'}}">
    <td>{{$notification->created_at->format('d.m.Y')}}</td>
    <td>
      @include('admin.notifications.'.class_basename($notification->type))
    </td>
    <td><icon-with-hidden-form :icon-class='"fas fa-circle"' :form-action="'/admin/notifications/{{$notification->id}}/edit'">
     <template slot="token">
       @csrf
     </template>
    </icon-with-hidden-form></td>

  </tr>
  @endforeach
</table>

</div>

<div class="col-12 my-4 pagination">
{{$notifications->links()}}
</div>

@else
  <h2>Nemate ni jednu notifikaciju</a>
@endif


@endsection
