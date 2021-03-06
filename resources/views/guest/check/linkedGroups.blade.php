<div class="row">
<div class="col-12 mb-4">
  <h4 class="c5 underlined text-center w-100">Povezane grupe proizvoda</h4>
</div>

<div class="col-12">
<div class="row linkedGroupsRow">

@foreach ($product->productGroups as $group)
 <a href="{{route('checkProductGroup', $group->id)}}" class="col-10 offset-1 {{count($product->productGroups) < 5? "col-md-6" : "col-md-4"}} offset-md-0 group rounded d-flex py-1 py-sm-2 mb-2 py-md-1 mb-md-3 noUnderline">
   <div class="row w-100 rounded py-md-2">
     <div class="col-8 d-flex align-items-center "><h4 class="text-center w-100 c5">{{$group->name}}</h4></div>
     <div class="col-4 groupImg"><img src="/images/{{$group->image}}" alt="slika grupe proizvoda"></div>
   </div>
 </a>
@endforeach
</div>
</div>
</div>
