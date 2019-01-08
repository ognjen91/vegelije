@extends('layouts.admin')

@section('content')


  <div class="col-10 offset-1 mb-4">

  <div class="row text-center py-3">
    <h3 class='text-center w-100 c2'><strong>Profil moderatora {{$user->name}}</strong></h3>
  </div>
  <form action="{{route('editProfile', $user->id)}}" method="post" class='w-100'>
    @csrf
    <div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" value="{{$user->email}}" name="email" id="inputEmail3" placeholder="{{$user->email}}">
      </div>
    </div>
    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Nova lozinka (ostavite prazno ukoliko ne želite da promenite)</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" name="newPassword" id="inputPassword3">
      </div>
    </div>

    <div class="form-group row">
      <div class="offset-sm-2 col-sm-10">
        <button type="submit" class="btn btn-primary btn-block btn-lg c1Button">Promjeni podatke!</button>
      </div>
    </div>
  </form>

  </div>



  <div class="col-12 py-3">
  <h4 class="c1 text-center mb-4">Proizvodi koje ste odobrili i ubacili</h4>
{{-- {{dd($user->products)}} --}}
  <listing-products-and-product-groups :products="{{$usersProducts}}" :product-groups="{{$usersProductGroups}}"></listing-products-and-product-groups>
  </div>






@endsection
