<template lang="html">
  <div class="product col-10 col-md-8  col-lg-6  pt-2 pb-4 mr-lg-4">

    <div class="row">

      <div class="rankingInfo col-12 col-lg-2 d-flex flex-column align-items-center justify-content-center">
        <h2 class='text-center c2 ranking rounded-circle'><strong>{{index+1}}</strong></h2>
        <p class='text-center c2'><small>{{product.viewsCount}} <span v-if="product.viewsCount%10!==1">pregleda</span><span v-else>pregled</span></small></p>
        <h4 class='text-center' v-if="index<=2"><i class="fas fa-crown d-inline d-sm-inline-block" :class="{gold : index ==0, silver : index == 1, bronze : index ==2}"></i></h4>
      </div>

      <!-- SLIKA PROIZVODA -->
     <div class="productImage col-5 col-lg-4 topProductImage">
       <img :src="'/images/' + product.image" alt="product image" :id="index">
     </div>
     <!-- SLIKA PROIZVODA -->

     <!-- INFO -->
     <div class="col-7 col-lg-6 productQuickInfo">
       <h6 class="d-md-none mb-1 spaced px-1 text-center c2 c1-md w-100 mb-2"><strong>{{product.name}}</strong></h6>
       <h3 class="d-none d-md-inline-block mb-1 spaced px-1 text-center c2 c1-md w-100 mb-2">{{product.name}}</h3>


         <a v-if='typeof product.manufacturer !== "undefined"' class="fo1 mb-1 text-center  w-100 c2Link  mb-2" :href="'/proizvodjac/'+ product.manufacturer.id">
        <span>proizvodi </span>  <span class="underlined c2 c1-md"> {{product.manufacturer.name}} </span>
        </a>
        <a  class="fo1 mb-1 text-center  w-100 c2Link mb-2" :href="'/grupa_proizvoda/'+ product.id" v-else>
        <span class="underlined c2"> grupa proizvoda </span>
       </a>

        <a class='fo1 mb-1 text-center  w-100 c2Link mb-2' :href="'/kategorija/'+product.category.name">
          <span>u kategoriji </span><br class='d-md-none'> <span class="underlined c2 c1-md">{{product.category.name}}</span>
        </a>

        <a  class="btn btn-primary rounded mt-2  vegelijeButton" :href="toProduct">Vege li je?</a>
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
.gold{
  color: #FFD700 !important;
}

.silver {
  color : #C0C0C0 !important;
}

.bronze {
  color : #CD7F32 !important;
}
</style>
