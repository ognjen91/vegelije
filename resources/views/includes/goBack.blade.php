{{-- {{dd(url()->previous(), config('app.url'))}} --}}
<h1>
  <a href="{{strpos(url()->previous(), config('app.url', 'vegelije') ) !== false ? url()->previous() : route('homepage')}}" class="backRouteLink">
    <i class="c1 fas fa-arrow-circle-left ml-3 mt-3 mb-2 backRoute"></i>
  </a>
</h1>
