@if(session('success'))
<div class="row successRow md-4 px-3 py-2 py-md-3 justify-content-center" id="notice">
  <div class="col-8 alert alert-success py-2">
    <h3 class="text successMsg text-center">{{session('success')}}</h3>
  </div>
</div>
@endif

<style media="screen">
.successRow{
  display: flex;
}
</style>


<script>

</script>
