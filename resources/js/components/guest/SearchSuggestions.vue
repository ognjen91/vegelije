<template lang="html">
  <div class="row" v-if="results.length && showSuggestions" id='productSuggestions'>
    <div class="col-12 searchSuggestions">
      <ul class="suggestions">

            <li v-for='(result,index) in results'  @click="set(result)">{{result}}</li>

      </ul>

    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      results : [],
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      wasClickedOnSuggestion : false
    }
  },

  methods : {
    set(product){
      this.$store.commit('setSearchTerm', product);
      this.results = []
      this.changeSuggestionsShowStatus(false);
      this.wasClickedOnSuggestion = true;
    },
    changeSuggestionsShowStatus(bool){
      this.$store.commit('showProductSuggestions', bool);
    }
  },


  computed : {
    searchTerm(){
      return this.$store.getters.getSearchTerm;
    },
    showSuggestions(){
      return this.$store.getters.getShowProductSuggestions;
    }

  },

  watch : {
    searchTerm(val){
      this.changeSuggestionsShowStatus(true);
      if(this.wasClickedOnSuggestion){
        setTimeout(()=>this.wasClickedOnSuggestion=false, 300); //ovo rijesava problem da se ne mora kliknuti 2 puta... ruzno ali rijesava
        return;
      }
        axios.post('/searchSuggestions',
        { "_token" : this.csrf,
          "term" : this.searchTerm
        })
        .then((response)=>{
          if(response.status == 200){
            this.results = response.data;
          } else {
            this.results = [];
          }
        })

    }
  },

  mounted(){
    $('body').click((e) => {
    if ($(e.target).closest('#productSuggestions').length === 0) {
       this.changeSuggestionsShowStatus(false);
    }
});
  }
}
</script>

<style lang="css">
</style>
