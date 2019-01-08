<template lang="html">
<input type="text" id="manufacturersSearch" class="w-100 rounded p-1 fo1 w-100" @keyup='setManufacturerTerm'
v-model="searchText" placeholder="unesite naziv proizvođača">
</template>

<script>
export default {
  props : ['placeholder'],

  data(){
    return{
      searchText : ""
    }
  },

  computed : {
    storeValue(){
      return this.$store.getters.getManufacturerTerm;
    }
  },
  methods : {
    setManufacturerTerm(){
      this.$store.commit('setManufacturerTerm', this.searchText)
    }
  },

  watch : {
   storeValue(val){
     this.searchText = val;
   }
  }
}
</script>

<style lang="css">

</style>
