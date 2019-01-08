@extends('layouts.admin')

@section('content')


<div class="col-12">
  <div class="row  px-4">
    {{-- ============GLAVNA REKLAMA============ --}}
    <form action="{{route('setMainAd')}}" method="post" class="col-12 col-md-6 d-flex flex-column justify-content-center">
      @csrf
      <h2 class='text-center mb-2 mb-md-3'>Izbor glavne reklame <a href="{{route('createMainAd')}}" class='btn btn-primary vegelijeButton'>Dodaj novu</a></h2>
      <table class="w-100">
        <tr>
          <th>Naziv</th>
          <th>Postavi za aktivnu</th>
          <th></th>

        </tr>
        @foreach ($mainAds as $ad)
          <tr>
            <td class="py-2"><a href="{{route('editMainAd', $ad->id)}}">{{$ad->name}}</a></td>
            <td class="py-2"><input type="checkbox" name="active[]" value="{{$ad->id}}" @if($ad->active) checked @endif></td>
            <td class="py-2"><a href="{{route('editMainAd', $ad->id)}}" class="btn btn-primary">Pogledaj</a></td>



          </tr>
        @endforeach
        {{-- <tr>
          <td class="py-2">Ni jedna da ne bude aktivna</a></td>
          <td class="py-2"><input type="radio" name="active" value="0"></td>
          <td class="py-2"></td>
        </tr> --}}
      </table>

      <input type="submit" value="Odaberi glavnu reklamu" class="btn btn-primary bnt-block btn-lg vegelijeButton my-4">
    </form>

    {{-- ===========DRUGA REKLAMA============= --}}
    <form action="{{route('setSecondAd')}}" method="post" class="col-12 col-md-6 d-flex flex-column justify-content-center">
      @csrf
      <h2 class='text-center mb-2 mb-md-3'>Izbor sporedne reklame <a href="{{route('createSecondAd')}}" class='btn btn-primary vegelijeButton'>Dodaj novu</a></h2>
      <table class="w-100">
        <tr>
          <th>Naziv</th>
          <th>Postavi za aktivnu</th>
          <th></th>

        </tr>
        @foreach ($secondAds as $ad)
          <tr>
            <td class="py-2"><a href="{{route('editSecondAd', $ad->id)}}">{{$ad->name}}</a></td>
            <td class="py-2"><input type="radio" name="active" value="{{$ad->id}}" @if($ad->active) checked @endif></td>
            <td class="py-2"><a href="{{route('editSecondAd', $ad->id)}}" class="btn btn-primary">Pogledaj</a></td>

          </tr>
        @endforeach
        <tr>
          <td class="py-2">Ni jedna da ne bude aktivna</a></td>
          <td class="py-2"><input type="radio" name="active" value="0"></td>
          <td class="py-2"></td>
        </tr>
      </table>

      <input type="submit" value="Odaberi sporednu reklamu" class="btn btn-primary bnt-block btn-lg vegelijeButton my-4">
    </form>

  </div>
</div>








@endsection
