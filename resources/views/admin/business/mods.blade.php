@extends('layouts.admin')

@section('content')


<div class="col-12 mb-3 mb-lg-4 py-2 mb-2 mb-lg-4">
  <div class="row text-center py-3">
    <h5 class='text-center w-100 c1'><strong>Vegelije crew</strong></h5>
  </div>
  <div class="row">
    <div class="col-3 col-md-3">
      <h5 class="text-center">Ime</h5>
    </div>
    <div class="col-4 col-md-3">
      <h5 class="text-center">Email</h5>
    </div>
    <div class="col-3  col-md-3">
      <h5 class="text-center">Uloga</h5>
    </div>
    <div class="col-2 col-md-3">
      <h5 class="text-center">Ovlasti/Razvlasti</h5>
    </div>
    @foreach ($users as $user)
      <div class="col-12">
        <div class="row">
          <div class="col-4 col-md-3">
            <p class="text-center"><strong>{{$user->name}}</strong></p>
          </div>
          <div class="col-4 col-md-3">
            <p class="text-center">{{$user->email}}</p>
          </div>
          <div class="col-3 col-md-3">
            <p class="text-center">{{$user->roles[0]->name}}</p>
          </div>
          <div class="col-1 col-md-3 d-flex justify-content center">
            @if(!$user->hasAnyRole('Admin'))
            <icon-warning-and-action :url="'{{route('editUsersRole', $user->id)}}'" :target-item-name="'{{$user->name}}'" :icon='"fa fa-arrow-right"' :method="'post'">
              <p slot="msg">
            @if($user->hasAnyRole('Moderator'))
              Da li ste sigurni da želite da oduzmete zvanje moderatora od
            @else
              Da li želite da postavite za moderatora
            @endif
              </p>
             </icon-warning-and-action>
           @endif
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>

<div class="col-10 offset-1">

<div class="row text-center py-3">
  <h5 class='text-center w-100 c2'><strong>Kreiranje novog moderatora</strong></h5>
</div>
<form action="{{route('addMod')}}" method="post" class='w-100'>
  @csrf
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Ime</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="name" id="inputEmail3" placeholder="Ime">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="email" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="password" id="inputPassword3" placeholder="Password">
    </div>
  </div>

  <div class="form-group row">
    <div class="offset-sm-2 col-sm-10">
      <button type="submit" class="btn btn-primary btn-block btn-lg c1Button">Kreiraj!</button>
    </div>
  </div>
</form>

</div>




@endsection
