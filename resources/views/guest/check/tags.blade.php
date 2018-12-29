{{-- <div class="row d-block"> --}}
  <h3 class="text-center w-100 {{isset($product->manufacturer_id)? "c5" : "c2"}}">Oznake {{isset($product->manufacturer_id)? "proizvoda" : "grupe"}} </h3>
{{-- </div> --}}


    @foreach ($tags as $key=>$tag)
     @if($key<22)  <a class="@if(isset($product->manufacturer_id)) productTagBtn @else c1Button  @endif btn btn-primary rounded mx-2 my-2 " href="{{route('taggedProducts', $tag->name)}}">{{$tag->name}}</a> @endif
    @endforeach
