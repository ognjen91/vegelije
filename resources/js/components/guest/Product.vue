<template lang="html">
  <div class="product col-10   col-sm-8  col-lg-5 offset-lg-0 pt-2 pb-4 mr-lg-4">

    <div class="row">

      <!-- SLIKA PROIZVODA -->
     <div class="productImage col-4 col-lg-5">
       <img :src="'/images/' + product.image" alt="product image" :id="index">
     </div>
     <!-- SLIKA PROIZVODA -->

     <!-- INFO -->
     <div class="col-8 col-lg-7 productQuickInfo">
       <h4 class="mb-1 spaced px-1 text-center c2 c1-md w-100 mb-2">{{product.name}}</h4>


         <a v-if='typeof product.manufacturer !== "undefined"' class="fo1 mb-1 text-center  w-100 c2Link  mb-2" :href="'/proizvodjac/'+ product.manufacturer.id">
        <span>proizvodi </span>  <span class="underlined c2 c1-md"> {{product.manufacturer.name}} </span>
        </a>
        <a  class="fo1 mb-1 text-center  w-100 c2Link mb-2" :href="'/grupa_proizvoda/'+ product.id" v-else>
        <span class="underlined c2"> grupa proizvoda </span>
       </a>

        <a class='fo1 mb-1 text-center  w-100 c2Link mb-2' :href="'/kategorija/'+product.category.name">
          <span>u kategoriji </span><br class='d-md-none'> <span class="underlined c2 c1-md">{{product.category.name}}</span>
        </a>

        <a  class="btn btn-primary rounded mt-2 px-2 vegelijeButton" :href="toProduct">Vege li je?</a>
     </div>


     </div>
</div>
</template>

<script>
export default {
  props: ['product', 'index'],

data(){
  return{
    // toProduct : typeof this.product.manufacturer !== "undefined"? "/proizvod/" + this.product.id : '/grupe/' + this.product.id
  }
},
  computed : {
    searchTerm(){
      return this.$store.getters.getSearchTerm;
    },
    manufacturerTerm(){
      return this.$store.getters.getManufacturerTerm;
    },
    toProduct(){
      let baseUrl = typeof this.product.manufacturer !== "undefined"? "/proizvod/" + this.product.id : '/grupe_proizvoda/' + this.product.id;
      if (this.searchTerm){
        let url = baseUrl + "?term=" + this.searchTerm;
        if (this.manufacturerTerm) url = url + "&manuf=" + this.manufacturerTerm;
        return url
      }
      return baseUrl
    }
  }
}
</script>

<style lang="css">
</style>
