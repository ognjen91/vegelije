<template lang="html">
  <div  id="productGroups" class="col-10 offset-1 d-flex justify-content-center" v-if="productGroups.length">
    <div class="row d-flex justify-content-center flex-wrap">
        <search-result v-for='(product, index) in productGroups' v-if='index<noOfResultsShown' :key='index' :product="product" :index='index'></search-result>
    </div>
    </div>
  </div>

  <div class="col-12 mb-4 pl-lg-5"  id="searchResults" v-else>
       <h2 class=" w-100 text-center text-danger mb-5">Nema pronađenih rezultata za ove kriterijume</h2>
  </div>
</template>

<script>
import {
    throttle
} from 'lodash'
export default {
    props: ['productGroups'],
    data() {
        return {
            noOfResultsShown: 10,
        }
    },


    methods: {

        loadNewResults: throttle(function(e) {
            if (this.shouldLoadMore()) this.noOfResultsShown += 8
        }, 500),

        shouldLoadMore() {
            if ($("#productGroups").length) {
                var resultsHeight = $("#productGroups").height();
                var resultsDistanceFromTop = $("#productGroups").offset().top;
                return (resultsHeight + resultsDistanceFromTop) * 0.75 <= window.scrollY + window.innerHeight
            } else {
                return false;
            }


        }

    },

    mounted() {
        window.addEventListener('scroll', this.loadNewResults);
    },

}
</script>

<style lang="css">
</style>
