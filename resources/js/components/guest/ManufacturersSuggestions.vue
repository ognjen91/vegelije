<template lang="html">
  <div class="row manufacturerSuggestions w-100" v-if='suggestionsExist && showSuggestions' id='manufacturerSuggestions'>
    <div class="col-12 searchSuggestions">
      <ul class="suggestions">

          <li v-for="(similarityIndex, result, index) in results" v-if="index<5" @click="set(result)">{{result}}</li>

      </ul>
    </div>
  </div>
</template>

<script>
var similarity = require("similarity")
import {sortNamesBySimilarity} from '../../helpers/sortNamesBySimilarity';
import {isEmptyObject} from '../../helpers/isEmptyObject';

export default {
    props: ['manufacturers'],
    data() {
        return {
            results: {},
            similarity : similarity,
            wasClickedOnSuggestion : false

        }
    },

    methods : {
      set(manufacturer){
        this.$store.commit('setManufacturerTerm', manufacturer);
        this.results = {}
        this.changeSuggestionsShowStatus(false);
        this.wasClickedOnSuggestion = true;

      },
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
          console.clear();

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



          console.log(nameSimilarityObject);
          let sorted = sortNamesBySimilarity(nameSimilarityObject);
          console.log(sorted);

          this.results = sortNamesBySimilarity(nameSimilarityObject);

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
