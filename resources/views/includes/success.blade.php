@if(session('success'))
<div class="row successRow md-4 px-3 py-1 justify-content-center">
  <div class="col-8 alert alert-success">
    <h3 class="text successMsg text-center">{{session('success')}}</h3>
  </div>
</div>
@endif

<style media="screen">
.successRow{
  display: flex;
}
</style>
