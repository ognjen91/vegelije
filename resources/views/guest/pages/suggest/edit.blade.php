@extends('layouts.app')
@section('pageTitle', 'PREDLOŽITE PROMENU')


@section('content')
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

  <div class="col-10 offset-1 col-md-8 offset-md-2 loggedUser mb-2 mb-md-4">
    <div class="row d-flex justify-content-end">
      <div class="avatar col-2 col-md-2 col-lg-1">
        <img src="{{$googleUser->user['picture']}}" alt="" class="rounded-circle">
      </div>
      <div class="d-flex flex-column align-items-center">
        <span class="c1"><strong>{{$googleUser->name}}</strong> </span>
        <a href="{{route('googleUserLogout')}}">izlogujte se</a>
      </div>
    </div>
  </div>

<div class="col-10 offset-1 col-md-8 offset-md-2 my-2 my-md-1 text-center">
  <h3 class="c1">
    Predlog za promenu podataka proizvoda {{$product->name}} proizvođača {{$product->manufacturer->name}}
  </h3>
  <p class='c2'><strong>{{$googleUser->user['gender'] == 'female'? 'Poštovana' : 'Poštovani'}} {{$googleUser->user['name']}},
  <span class="c1">Vegelije</span> Vam zahvaljuju na pažnji i uloženom vremenu da, zajedno sa nama, poboljšate sadržaj aplikacije.
  Po unosu, naši moderatori će pregledati predlog i ukoliko je predlog konstruktivan, rado ćemo ga prihvatiti.</strong></p>
</div>


<div class="my-4 col-10 offset-1 col-md-8 offset-md-2">
<form action="{{route('storeEditSuggestion', $product->id)}}" method='post' class='w-100'>
   @csrf
    <div slot="commentEditor" class="my-4 w-">
      <h4 class='c2 text-center mb-3'><strong>Tekst predloga</strong></h4>
      <textarea name="suggestion" class="form-control productDescription w-100">
        @errors
        {{old('description')}}
        @else
        @edit {{$product->description}} @endedit
        @enderrors
      </textarea>
      @include('admin.createOrEdit.editorSettings')
    </div>

    <be-mentioned :suggested-by="'{{$googleUser->user['name']}}'">
      <template slot='text'>
        Možemo li da zapamtimo Vaše podatke (Google mail), u slučaju da imamo nedoumica oko Vašeg predloga i da su nam
        potrebne dodatne informacije ili pojašnjenja? <br>
      </template>
      <template slot='proposerEmail'>
        <input type="hidden" name="proposerEmail" value="{{$googleUser->user['email']}}">
      </template>
    </be-mentioned>

    <input type="submit" value="POŠALJITE PREDLOG!" class="btn btn-primary btn-lg btn-block vegelijeButton my-4">
</form>
</div>

@endsection

<style>
.content{
  min-height: 90vh;
}

</style>
