<template lang="html">
  <div class="noProductDanger" v-if="dangerShown">

    <h1 class='mb-3 text-center w-100'><strong>Molimo ukucajte proizvod za pretragu!</strong></h1>
    <button type="button" class="btn btn-primary btn-lg c1Button" @click='closeDangerWindow'>Ok!</button>


  </div>
</template>

<script>
export default {
  computed : {
    dangerShown(){
      return this.$store.getters.isDangerShown
    }
  },

  methods : {
    closeDangerWindow(){
      this.$store.commit('showNoProductDanger', false)
    }
  }
}
</script>

<style lang="css">
</style>
