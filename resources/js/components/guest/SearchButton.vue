<template lang="html">

  <img src="/images/assets/search.png" alt="search product" @click="search" id='searchImg'>


</template>

<script>
export default {
  data(){
    return{
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    }
  },

  methods : {
    search(){
      if(!this.productTerm){
        this.$store.commit('showNoProductDanger', true);
        setTimeout(()=>this.$store.commit('showNoProductDanger', false), 5000)
        return;
      }
      let data = {
        "_token" : this.csrf,
        "product" : this.productTerm,
        "manufacturer" : this.manufacturerTerm
      }
      this.$store.dispatch('searchTerms', data)
      this.$store.commit('showSearchResults', true)

    }
  },

    computed : {
      productTerm(){
        return this.$store.getters.getSearchTerm
      },
      manufacturerTerm(){
        return this.$store.getters.getManufacturerTerm
      },
      searchResultsShown(){
        return this.$store.getters.areSearchResultsShown
      }
    },

    watch : {
      searchResultsShown(val){
        if(val){
          $("#searchResults").css('min-height', '90vh');
          $(".initial").hide();
          $("#searchResults").fadeIn(200, ()=>$("#searchResults").css('min-height', 'initial'));
          $("#randomTags").addClass('tagsOnSearch');
        }
      }
    },

    mounted(){
      document.body.addEventListener( 'keyup', (e)=>{
        if ( e.keyCode == 13 ) {
          // Simulate clicking on the submit button.
          // submitButton.click();
          this.search();
        }
      });
    }

}
</script>

<style lang="css">
</style>
