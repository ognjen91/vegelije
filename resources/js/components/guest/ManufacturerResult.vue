<template lang="html">
  <li class='col-12 mb-3 manufacturerResult py-2 py-md-4 py-lg-1'>
    <div class="row">

      <div class="col-12 col-lg-6 mb-1">
        <div class="row my-1 mt-sm-2 mb-sm-3 d-flex">
            <div class="col-12 col-lg-12 d-flex align-items-center" :class="{'col-sm-6 col-md-7' : manufacturer.image !=='placeholder.png'}">
               <h2 class='c2 text-center w-100 spaced2'><strong>{{manufacturer.name}}</strong></h2>
             </div>
            <div class="manufImageInResult col-12 col-sm-6 col-md-5 col-lg-10 offset-lg-1 mb-sm-3 mb-lg-0" v-if="manufacturer.image !== 'placeholder.png'">
              <img :src="'/images/'+manufacturer.image" :alt="'slika proizvođača' + manufacturer.name">
            </div>
            <div class="col-12 manufName">
              <h4 class='c1 text-center w-100' :class="{'mb-lg-3' : manufacturer.image !== 'placeholder.png'}">{{noOfProducts}}
                <span v-if="lastDigit == 1">proizvod</span>
                <span v-else>proizvoda</span>
            </h4>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-4 offset-lg-1 d-lg-flex">
      <div class="gotoManuf d-flex">
        <a :href="'/proizvodjac/'+ id" class="btn btn-primary btn-block btn-lg vegelijeButton">
        Pogledajte proizvode
        </a>
      </div>
      </div>
    </div>
  </li>
</template>

<script>
export default {
  props : ['manufacturer', 'id','index', 'noOfProducts'],
  computed : {
    lastDigit(){
      return this.noOfProducts.toString().split('').pop();
    }
  }
}
</script>

<style lang="css">
</style>
