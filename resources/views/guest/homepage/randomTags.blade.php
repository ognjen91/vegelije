

<div class="row  d-flex flex-wrap px-1 px-lg-3">
  <div class="col-12">
    <h5 class='text-center c2'><strong>Oznake</strong></h5>
  </div>
  @foreach ($randomTags as $key=>$tag)
    {{-- mali ekrani --}}
  @if($key<9) <a class="d-sm-none btn btn-primary c2Button rounded mx-2 my-2" href="{{route('taggedProducts', $tag->name)}}">{{$tag->name}}</a> @endif
  @if($key<12) <a class="d-none d-sm-inline-block d-md-none c2Button btn btn-primary rounded mx-2 my-2" href="{{route('taggedProducts', $tag->name)}}">{{$tag->name}}</a> @endif
    {{-- veliki ekrani --}}
  @if($key<16)<a class="d-none d-md-inline-block btn btn-primary c1Button rounded mx-2 my-1 randomTag" href="{{route('taggedProducts', $tag->name)}}">{{$tag->name}}</a> @endif
  @endforeach
</div>
