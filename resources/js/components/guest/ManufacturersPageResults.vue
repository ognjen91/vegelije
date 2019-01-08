<template lang="html">
  <span>
    <div v-if="firstInput || !manufacturerTerm">
      <div class="col-12 searchResultsOf">
        <ul class="row resultsOf">
          <manufacturer  v-for="(manufacturer, index) in manufacturers" :key='index'
          :manufacturer="manufacturer" :id="manufacturer.id" class="col-12 mb-3 manufacturerResult" :noOfProducts="manufacturer.products.length">
          </manufacturer>
        </ul>
      </div>
    </div>

    <div class="col-12 searchResultsOf" v-if='suggestionsExist && !firstInput' id='manufacturersResults'>
      <ul class="row resultsOf">
        <manufacturer  v-for="(manufacturer, index) in results" :key='index'
        :manufacturer="manufacturer" :id="manufacturer.id" class="col-12 mb-3 manufacturerResult" :noOfProducts="manufacturer.products.length">
        </manufacturer>
      </ul>
    </div>

  <div v-if="!firstInput && !suggestionsExist && manufacturerTerm" class="col-12 searchResults mb-2">
    <h2 class="colorDanger w-100 py-5 my-5 text-center">Nema rezultata. Molimo, unesite drugi pojam.</h2>
  </div>
  </span>
</template>

<script>
var similarity = require("similarity")
import {sortNamesBySimilarity} from '../../helpers/sortNamesBySimilarity';
import {isEmptyObject} from '../../helpers/isEmptyObject';
import manufacturer from './ManufacturerResult.vue';

export default {
    components : {manufacturer},
    props: ['manufacturers'],
    data() {
        return {
            results: {},
            similarity : similarity,
            wasClickedOnSuggestion : false,
            firstInput : 1

        }
    },

    methods : {

      changeSuggestionsShowStatus(bool){
        this.$store.commit('showManufacturerSuggestions', bool);
      }
    },

    computed: {
        manufacturerTerm() {
            return this.$store.getters.getManufacturerTerm
        },
        suggestionsExist(){
          return  !jQuery.isEmptyObject(this.results);
        },
        showSuggestions(){
          return this.$store.getters.getShowManufacturerSuggestions;
        }
    },

    watch: {
        manufacturerTerm: function(val) {
          this.firstInput = 0;
          this.changeSuggestionsShowStatus(true);
          if(this.wasClickedOnSuggestion){
            setTimeout(()=>this.wasClickedOnSuggestion=false, 300); //ovo rijesava problem da se ne mora kliknuti 2 puta... ruzno ali rijesava
            return;
          }
          let input = val.trim().toLowerCase();
          if (!input) {
            return this.results = {}
          }

          let nameSimilarityObject = {};
          // console.clear();

            let inputLength = input.length;
            for (var i in this.manufacturers){
              let originalName = this.manufacturers[i].name;
              let manufName = this.manufacturers[i].name.toLowerCase();
              let manufNameTrimed = manufName.slice(0, inputLength);
              let similarity = this.similarity(input, manufName);



                let oneOfWordsInManufNameStartsWithInput = false;
                let oneOfWordsInManufNameContainsInput = false;
                let wordsInManufName = this.manufacturers[i].name.split(" ");
                //provjera da li neka od rijeci u nazivu pocinje sa inputom
                for(i in wordsInManufName){
                  if (wordsInManufName[i].toLowerCase().startsWith(input)){
                    oneOfWordsInManufNameStartsWithInput = true;
                    break;
                  }
                }
                //provjera da li neka od rijeci u nazivu proizvodjaca sadrzi string
                for(i in wordsInManufName){
                  if (wordsInManufName[i].toLowerCase().includes(input)){
                    oneOfWordsInManufNameContainsInput = true;
                    break;
                  }
                }

              //konacno, ubac u property za rederovanje
              if(oneOfWordsInManufNameStartsWithInput){
                nameSimilarityObject[originalName] = 1
              } else if(similarity>0.5){
                nameSimilarityObject[originalName] = similarity;
              } else {
                if(oneOfWordsInManufNameContainsInput) nameSimilarityObject[originalName] = 0.5
              }
            }



          let sorted = sortNamesBySimilarity(nameSimilarityObject);
          let results = [];
          for(let x in sorted){
            for(let y in this.manufacturers){
               if (this.manufacturers[y].name == x){
                 results = [...results, this.manufacturers[y]];
                 break;
               }
            }
          }

           // this.results = sortNamesBySimilarity(nameSimilarityObject);
           this.results = results;


          //treba mi i id svakog proizvodjaca pa

            }
        },

        mounted(){
          $('body').click((e) => {
          if ($(e.target).closest('#manufacturerSuggestions').length === 0) {
             this.changeSuggestionsShowStatus(false);
          }
      });
        }
    }
</script>

<style lang="css">
</style>
