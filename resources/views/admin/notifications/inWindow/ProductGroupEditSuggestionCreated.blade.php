<div class="notification suggestionNotification">
  <a href="{{route('productGroupEditSuggestionReview', $notification->data['id'])}}">
    <div><p>
      @if(!$notification->read_at)
      Novi predlozi promene podataka za grupu proizvoda
      @else
      Predlog za promenu podataka grupe proizvoda
      @endif
      <strong class='mr-2'> {{$notification->data['productGroupName']}}</strong>

      <i class="fas fa-arrow-right"></i></p></div>
  </a>
</div>
