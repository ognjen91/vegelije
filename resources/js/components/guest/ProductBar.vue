<template lang="html">
    <div>
      <input type="text" id="productBar" class="form-control rounded px-1 fo1 w-100" :placeholder='"npr "+placeholder1+" ili "+placeholder2' v-model='searchTerm' v-on:keyup='setSearchTerm'>
    </div>
</template>

<script>
import {throttle} from 'lodash'
export default {
  props : ['previous', 'previouslySearchedTerm', 'previouslySearchedManufacturer'],

  data(){
    return {
      searchTerm : "",
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

    }
  },

  methods : {
    setSearchTerm(){
      this.$store.commit('setSearchTerm', this.searchTerm)
    }
  },

  computed : {
    storeSearchTerm(){
      return this.$store.getters.getSearchTerm;
    },
    placeholder1(){
      let placeholders = [
        'čokolada', "napolitnake", "mammas pizza", "bananica", "Twix", "praline", "Integrino", "pasta"
      ]
      return placeholders[Math.floor(Math.random()*placeholders.length)];
    },
    placeholder2(){
      let placeholders = [
        "Žele Zeka", "Piškote", "emuglator", "ratluk", "soja sos", "pita", "vino", "pivo", "emulgator E220"
      ]
      return placeholders[Math.floor(Math.random()*placeholders.length)];
    }
  },


  mounted(){
    const bars = document.getElementById("bars")
    let originalOffset = bars.offsetTop;
    window.addEventListener('scroll', throttle(function(){
      window.scrollY >= originalOffset? bars.classList.add('fixedToTop') : bars.classList.remove('fixedToTop');
      if(window.innerWidth >= 768){
        $('.fixedToTop').length? $("#randomTags").animate({ top: $("#bars").height()+"px"}, 200 ) : $("#randomTags").css('top', 'initial');
      }

    }, 300))

    //ako je prethodno vrsena pretraga, tj ako se vracam sa stranice rezultata gdje je vrsena pretraga...
    //..., ono sto sam dobio iz sesije, ako je setovana u ProductController@view i proslijedjeno ovoj komponenti putem WelcomeController-a
    if (typeof this.previouslySearchedTerm !== 'undefined'){
      this.$store.commit('setSearchTerm', this.previouslySearchedTerm);
      typeof this.previouslySearchedManufacturer !== 'undefined'? this.$store.commit('setManufacturerTerm', this.previouslySearchedManufacturer) :  this.$store.commit('setManufacturerTerm', "");
      let data = {
        "_token" : this.csrf,
        "product" : this.previouslySearchedTerm,
        "manufacturer" : this.previouslySearchedManufacturer !== 'undefined'? this.previouslySearchedManufacturer : ""
      };
      this.$store.dispatch('searchTerms', data)

    }

  },

  watch :{
    storeSearchTerm(val){
      this.searchTerm = val;
    }
  }


}
</script>

<style lang="css">

</style>
