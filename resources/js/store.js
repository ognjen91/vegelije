import Vue from 'vue';


export default {
    state: {
      //admin
       random : 0,
       storeOrUpdateFormParams : { //bice komit iz komponentne productOrProductGroup
         isExactProduct : true,
         actionUrl : "",
         editingProduct : false
       },
       suggestionFormParams : {
         isExactProduct : true,
         actionUrl : "",
       },

       //guest
       searchTerm : '',
       manufacturerTerm : "",
       showProductSuggestions : false,
       showManufacturerSuggestions : false,
       searchResultsShown : false,
       showNoProductDanger : false,

       results : {'exact' : [],
                  'other' : []
                }


    },



    getters: {
      //admin
      getRandom : (state)=>state.random,
      getResults : (state)=>state.results,
      getStoreOrUpdateFormParams : state => state.storeOrUpdateFormParams,

      //guest
      getSearchTerm : state => state.searchTerm,
      getManufacturerTerm : state => state.manufacturerTerm,
      getShowProductSuggestions : state => state.showProductSuggestions,
      getShowManufacturerSuggestions : state => state.showManufacturerSuggestions,
      areSearchResultsShown : state=>state.searchResultsShown,
      isDangerShown : state=>state.showNoProductDanger

    },



    mutations: {

     setStoreOrUpdateFormParams(state, payload){
        state.storeOrUpdateFormParams.actionUrl = payload.actionUrl;
        state.storeOrUpdateFormParams.isExactProduct = payload.isExactProduct;
        state.storeOrUpdateFormParams.editingProduct = payload.editingProduct;
        // state.storeOrUpdateFormParams = payload;
     },

     //guest
     setSearchTerm(state, payload){
       state.searchTerm = payload
     },
     setManufacturerTerm(state, payload){
       state.manufacturerTerm = payload
     },
     showProductSuggestions(state, payload){
       state.showProductSuggestions = payload
       if(payload) state.showManufacturerSuggestions = !payload
     },

     showManufacturerSuggestions(state, payload){
       state.showManufacturerSuggestions = payload
       if(payload) state.showProductSuggestions = !payload
     },

     updateResults(state, payload){
       state.results = {};
       state.results = payload
     },

     showSearchResults(state, payload){
       state.searchResultsShown = payload
     },
     showNoProductDanger(state, payload){
       state.showNoProductDanger = payload
     }


    },

    actions: {

      searchTerms(context, payload) {
          axios.post('/search', payload)
              .then((response) => {
                  // console.log(response.data);
                  context.commit('updateResults', response.data);
              }).catch(error => {
                  context.commit('updateResults', [])
                // console.log(error.response.data)
              });
      },

    }
}
