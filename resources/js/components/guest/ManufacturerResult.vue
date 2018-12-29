<template lang="html">
  <li class='col-12 mb-3 manufacturerResult py-2 py-md-4'>
    <div class="row">
      <div class="col-12 col-lg-6">
        <h2 class='c1 text-center w-100'>{{manufacturerName}}</h2>
        <slot name="productsCount"></slot>
        <h4 class='c2 text-center w-100'>{{noOfProducts}}
           <span v-if="lastDigit == 1">proizvod</span>
           <span v-else>proizvoda</span></h4>
      </div>
      <div class="col-12 col-lg-4 offset-lg-1 d-flex justify-content-center">

        <a :href="'/proizvodjac/'+ id" class="btn btn-primary vegelijeButton">
        Pogledajte proizvode
        </a>

      </div>
    </div>
  </li>
</template>

<script>
export default {
  props : ['manufacturerName', 'id','index', 'noOfProducts'],
  computed : {
    lastDigit(){
      return this.noOfProducts.toString().split('').pop();
    }
  }
}
</script>

<style lang="css">
</style>
