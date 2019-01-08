<div class="notification suggestionNotification" >
  <a href="{{route('productGroupEditSuggestionReview', $notification->data['id'])}}">
    <div><p class="text-light px-3">
       @if(!$notification->read_at)

       Novi neobrađeni predlog za promenu podataka grupe proizvoda koji niste pregledali: grupa


      @else
      Predlog za promenu podataka grupe proizvoda
      @endif
      <strong class='mr-2'>{{$notification->data['productGroupName']}}</strong>
      <i class="fas fa-arrow-right"></i></p></div>
  </a>
</div>
