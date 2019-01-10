@extends('layouts.admin')

@section('content')

<div class="col-8 offset-2 mb-5">
  <div class="row">
    <div class="col-8 offset-2">
      <h2 class="c2 text-center">Čišćenje foldera 'images' od nepotrebnog sadžaja </h2>
      <h5 class="text-center text-danger">ukupno {{count($toDelete)}} fajlova je višak</h5>

      <div class="row d-flex flex-column">

          <div class="col-12">
            @foreach ($toDelete as $imgToDel)
            <div class="row">
              <div class="col-6 col-md-4  imgToDel mb-3 mb-md-4 mb-lg-5">
                <img src="/images/{{$imgToDel}}" alt="">
              </div>
              <div class="col-6 d-flex justify-content-center">
                <p class="text-center">{{$imgToDel}}</p>
              </div>
            </div>
              @endforeach
          </div>


      </div>



      <h5 class="c2 text-center">Unesite podatke za provjeru</h5>
    </div>
  </div>

  <div class="row">
    <div class="container">
  <form action="{{route('cleanImagesFolder')}}" method="post">
    @csrf
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
        <button type="submit" class="btn btn-primary btn-block btn-lg c1Button">Očisti!</button>
      </div>
    </div>
  </form>
</div>
  </div>
</div>







@endsection
