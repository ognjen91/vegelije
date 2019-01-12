@if($mainAds->count())
@php $mainAd = $mainAds[rand(0, $mainAds->count()-1)]; @endphp
<div class="row">
<a href="http://{{$mainAd->link}}" class='col-10 offset-1 mainDown'>
  <img src="/images/{{$mainAd->downImage}}" alt="">
</a>
</div>
@endif
