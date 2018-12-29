@php
$route = Route::currentRouteName();
$alphabetLetters = ["A", "B", "C", "D", "DŽ", "E", "F", "G", "H", "I", "J", "K",
                    "L", "Lj", "M", "N", "Nj", "O", "P", "R", "S", "Š", "T", "U", "V", "Z", "Ž", "X", "Y", "Q"]
@endphp


@if($route !== 'manufacturerProducts')
  @foreach ($alphabetLetters as $letter)
    <div><a href="{{route($route, $letter)}}">{{$letter}}</a></div>
  @endforeach
@else
  @foreach ($alphabetLetters as $letter)
    <div><a href="{{route($route, [$manufacturer->id, $letter])}}">{{$letter}}</a></div>
  @endforeach
@endif
