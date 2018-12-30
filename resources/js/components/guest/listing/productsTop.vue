<template lang="html">
  <div  id="products" class="col-10 offset-1 " v-if="products.length">
    <div class="row d-flex justify-content-center flex-wrap">
      <top-result v-for='(product, index) in products' :key='index'  :product="product" :index='index'></top-result>
    </div>
  </div>
</template>

<script>
import topResult from './../TopProduct.vue';
export default {
  components : {topResult},
  props : ['products'],
  data(){
    return{

    }
  },


  methods: {


},

mounted(){

},

}
</script>

<style lang="css">
</style>
