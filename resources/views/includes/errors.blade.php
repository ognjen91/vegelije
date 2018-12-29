@if ($errors->any())
  <div class="row errorsRow">
    <div class="col">
        <ul class='p-y-2 row'>
            @foreach ($errors->all() as $error)
                <li class='offset-2 col-8 text text-center alert alert-danger'><strong>{{ $error }}</strong></li>
            @endforeach
        </ul>
    </div>
  </div>
@endif


@if(session('error'))
<div class="row errorsRow md-4 px-3 py-2 d-flex justify-content-center">
  <div class="col-8 alert alert-danger">
    <h3 class="text text-center">{{session('error')}}</h3>
  </div>
</div>
@endif
