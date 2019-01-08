@extends('layouts.app')
@section('pageTitle', 'Homepage')

@section('content')



<h1>Zdravo, {{$user->getName()}}</h1>
{{-- <h2>Kako ste, {{$user->getNickname()}}</h2> --}}
<img src="{{$user->getAvatar()}}" alt="">








@endsection
