<div class="notification suggestionNotification" >
  <a href="/admin/imagesSuggestions/{{$notification->data['id']}}/edit">
    <div><p class="text-light px-3">
       @if(!$notification->read_at)

       Novi neobrađeni predlog za slike koji niste pregledali: proizvod


      @else
      Predlog za slike za proizvod
      @endif
      <strong class='mr-2'> {{$notification->data['productName']}} proizvođača {{$notification->data['productManufacturer']}}</strong>
      <i class="fas fa-arrow-right"></i></p></div>
  </a>
</div>
