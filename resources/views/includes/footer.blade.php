<footer class="row pt-5">
  @guest
  <div class="col-12 mb-3 categories">
    <div class="row px-3">
      @foreach ($categories as $category)
        <a href="/kategorija/{{$category->name}}" class="footerCat col-4 text-center mb-2"><strong>{{$category->name}}</strong></a>
      @endforeach
    </div>
  </div>
  <div class="col-12">
    <p class="text-center">App developed by Qzman <a class="underlined text-center" href="http://qzman.net">(www.qzman.net)</a></p></div>
  @endguest
</footer>
