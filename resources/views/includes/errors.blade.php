@if ($errors->any())
  <div class="row errorsRow py-2 py-md-3" id="notice">
    <div class="col">
        <ul class='py-2 row'>
            @foreach ($errors->all() as $error)
                <li class='offset-2 col-8 text text-center text-danger alert alert-danger mb-1 '><h4><strong>{{ $error }}</strong></h4></li>
            @endforeach
        </ul>
    </div>
  </div>
@endif


{{-- @if(session('error'))
<div class="row errorsRow md-4 px-3 py-2 d-flex justify-content-center">
  <div class="col-8 alert alert-danger">
    <h3 class="text text-center text-danger">{{session('error')}}</h3>
  </div>
</div>
@endif --}}
