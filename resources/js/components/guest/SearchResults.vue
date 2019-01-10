<template lang="html">

  <div class="row mb-4 pl-lg-5"  id="searchResults" v-if="results.exact.length || results.other.length">

    <h1>
      <a  class="ml-2 backRouteLink" @click="closeResults">
        <i class="c1 fas fa-arrow-circle-left ml-3 mt-3 mb-2 backRoute"></i>
      </a>
    </h1>

    <div class="col-12">
      <h3 class="py-4 mb-4 text-center c1">
        Rezultati pretrage : {{ searchTerm }} <span v-if="manufacturerTerm">, proizvođač "{{manufacturerTerm}}"</span>
       </h3>
    </div>

    <!-- <div class="col-12 mb-3">
      <h4 class='text-center c2 goBack' @click="closeResults"><i class="fas fa-arrow-circle-left"></i> Nazad</h4>
    </div> -->


    <h3 class="py-2 mb-3 mt-lg-4 mb-lg-5 text-center spaced c1 w-100">
      <strong class='fo2'>Tačni rezultati</strong>
    </h3>
    <template v-if="results.exact.length">
      <div class="col-12">
        <div class="row mb-4 pl-lg-5 d-flex justify-content-center">
          <search-result v-for="(product, index) in results.exact" :key='index' :product="product" :index='index'></search-result>
        </div>
      </div>

    </template>
   <template v-else>
     <div class="col-12 mb-1">
       <h2 class="w-100 text-center c2">Nema tačnih rezultata za traženi pojam</h2>
     </div>
   </template>



    <h3 class="py-2 mb-3 mt-lg-4 mb-lg-5 text-center spaced c1 w-100"  v-if="results.other.length">
      <strong class='fo2'>Ostali rezultati</strong>
    </h3>
    <template v-if="results.other.length">
      <div class="col-12">
        <div class="row mb-4 pl-lg-5 d-flex justify-content-center">
          <search-result v-for="(product, index) in results.other" :key='index' v-if='index<noOfResultsShown' :product="product" :index='index'></search-result>
        </div>
      </div>
    </template>

  </div>


  <!-- AKO NEMA REZULTATA.... -->
  <div class="row mb-4 pl-lg-5"  id="searchResults" v-else>
  <div class="col-12"  id="searchResults" >

      <h2 class="colorDanger w-100 pt-3 mb-5 my-5 text-center">Nema pronađenih rezultata za traženi pojam</h2>
      <h2 class='col-12 text-center c2 goBack' @click="closeResults"><i class="fas fa-arrow-circle-left"></i> Nazad</h2>

  </div>
  </div>
  </template>

<script>
import {throttle} from 'lodash'
export default {

data(){
  return{
    noOfResultsShown : 10,
    searchTerm : "",
    manufacturerTerm : ""
  }
},


methods: {
  closeResults(){
    if(!this.searchResultsShown){
    $("#results").hide();
    $(".initial").fadeIn();
    $("#randomTags").removeClass('tagsOnSearch')} else{
      this.$store.commit('showSearchResults', false)
    }

  },

  loadNewResults : throttle(function(e){
  if (this.shouldLoadMore()) this.noOfResultsShown += 8
}, 500),


  shouldLoadMore(){
    if($("#searchResults").length){
      var resultsHeight = $("#searchResults").height();
      var resultsDistanceFromTop = $("#searchResults").offset().top;
      // console.log(window.innerHeight, window.scrollY, resultsHeight, resultsDistanceFromTop);
      // console.log((resultsHeight + resultsDistanceFromTop)  * 0.75 <= window.scrollY + window.innerHeight);
      return  (resultsHeight + resultsDistanceFromTop)  * 0.75 <= window.scrollY + window.innerHeight
    } else {
      return false;
    }


  }


},

computed : {
  results(){
    return this.$store.getters.getResults;
  },
  searchResultsShown(){
    return this.$store.getters.areSearchResultsShown
  },

},

mounted(){
  window.addEventListener('scroll', this.loadNewResults);
},

  watch: {
    searchResultsShown(val){
      if(!val){
        $("#results").hide();
        $(".initial").fadeIn();
        $("#randomTags").removeClass('tagsOnSearch');

      }
    },

    results(val){
      this.searchTerm = this.$store.getters.getSearchTerm
      this.manufacturerTerm = this.$store.getters.getManufacturerTerm
      $("#results").hide().fadeIn(200);
      this.$store.commit('showProductSuggestions', false);
      this.$store.commit('showManufacturerSuggestions', false);
    },

  },



}
</script>

<style lang="css">
</style>
