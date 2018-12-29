<template lang="html">
  <div  id="products" class="col-10 offset-1 " v-if="products.length">
    <div class="row d-flex justify-content-center flex-wrap">
      <search-result v-for='(product, index) in products' :key='index' v-if='index<noOfResultsShown' :product="product" :index='index'></search-result>
    </div>
  </div>

  <div class="col-12 mb-4 pl-lg-5"  id="searchResults" v-else>
       <h2 class=" w-100 text-center text-danger mb-5">Nema pronađenih rezultata za ove kriterijume</h2>
  </div>
</template>

<script>
import {throttle} from 'lodash'
export default {
  props : ['products'],
  data(){
    return{
      noOfResultsShown : 10,
    }
  },


  methods: {

    loadNewResults : throttle(function(e){
    if (this.shouldLoadMore()) this.noOfResultsShown += 8
  }, 500),

  shouldLoadMore(){
    if($("#products").length){
      var resultsHeight = $("#products").height();
      var resultsDistanceFromTop = $("#products").offset().top;
      // console.log(window.innerHeight, window.scrollY, resultsHeight, resultsDistanceFromTop);
      // console.log((resultsHeight + resultsDistanceFromTop)  * 0.75 <= window.scrollY + window.innerHeight);
      return  (resultsHeight + resultsDistanceFromTop)  * 0.75 <= window.scrollY + window.innerHeight
    } else {
      return false;
    }


  }

},

mounted(){
  window.addEventListener('scroll', this.loadNewResults);
},

}
</script>

<style lang="css">
</style>
