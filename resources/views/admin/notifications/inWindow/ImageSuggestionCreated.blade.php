<div class="notification suggestionNotification">
  <a href="/admin/imagesSuggestions/{{$notification->data['id']}}/edit">
    <div><p>
      @if(!$notification->read_at)
      Novi predlozi slika za proizvod
      @else
      Predlozi za slike za proizvod
      @endif
      <strong class='mr-2'> {{$notification->data['productName']}} proizvođača {{$notification->data['productManufacturer']}}</strong>

      <i class="fas fa-arrow-right"></i></p></div>
  </a>
</div>
