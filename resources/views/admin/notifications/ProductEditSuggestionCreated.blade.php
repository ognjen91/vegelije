<div class="notification suggestionNotification" >
  <a href="{{route('productEditSuggestionReview', $notification->data['id'])}}">
    <div><p class='text-light px-3'>
       @if(!$notification->read_at)

       Novi neobrađeni predlog za promenu podataka proizvoda koji niste pregledali: proizvod


      @else
      Predlog za promenu podataka proizvoda
      @endif
      <strong class='mr-2'> {{$notification->data['productName']}} proizvođača {{$notification->data['productManufacturer']}}</strong>
      <i class="fas fa-arrow-right"></i></p></div>
  </a>
</div>
