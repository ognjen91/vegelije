@extends('layouts.app')

@section('content')
<div class="col-12 d-flex align-items-center">
   <h3 class="text-center w-100"><strong>Registracija je onemogućena</strong></h3>
</div>
@endsection

<script type="text/javascript">
  setTimeout(()=>window.location.replace("{{route('homepage')}}"), 2000)
</script>



<style>
#app{
  background-color: rgba(#ffffff, 0) !important;
  background-image: linear-gradient(to right, #b29ec2, #fff);
}
.content{
  min-height: 60vh;
}
</style>
