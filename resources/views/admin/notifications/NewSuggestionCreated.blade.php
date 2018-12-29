<div class="notification suggestionNotification" >
  <a href="/admin/suggestions/{{$notification->data['id']}}/edit">
    <div><p>
       @if(!$notification->read_at)

       Nova neobrađen predlog korisnika koji niste pregledali:


      @else
      Neobrađeni predlog korisnika :
      @endif
      <strong class='mr-2'>{{$notification->data['name']}}</strong>
      <i class="fas fa-arrow-right"></i></p></div>
  </a>
</div>
