<template lang="html">
  <div  id="productGroups" class="col-10 offset-1 d-flex justify-content-center" v-if="productGroups.length">
    <div class="row d-flex justify-content-center flex-wrap">
        <top-result v-for='(product, index) in productGroups':key='index' :product="product" :index='index'></top-result>
    </div>
    </div>
  </div>
</template>

<script>
import topResult from './../TopProduct.vue';
export default {
    props: ['productGroups'],
    components : {topResult},
    data() {
        return {

        }
    },


    methods: {


    },

    mounted() {

    },

}
</script>

<style lang="css">
</style>
