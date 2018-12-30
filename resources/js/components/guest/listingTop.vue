<template lang="html">
  <div class="row">

    <div class="col-12 selectListing d-flex mb-2 mb-md-3">
      <p @click='activeComponent = "listingProducts"' :class="{'selectedListing' : activeComponent === 'listingProducts'}">PROIZVODI</p>
      <p v-if="typeof productGroups !== 'undefined'" @click='activeComponent = "listingProductGroups"' :class="{'selectedListing' : activeComponent === 'listingProductGroups' }">GRUPE <span class='d-none d-md-inline'>PROIZVODA</span></p>
    </div>

    <keep-alive>
      <component :is='activeComponent' :products="products" :product-groups="productGroups"></component>
    </keep-alive>


  </div>




</template>

<script>
import listingProducts from './listing/productsTop.vue'
import listingProductGroups from './listing/productGroupsTop.vue'
export default {
  components:{listingProducts, listingProductGroups},
  props : ['products', 'productGroups'],
  data(){
    return{
      activeComponent : 'listingProducts'
    }
  }
}
</script>

<style lang="css">
</style>
