<template lang="html">
  <div class="row">
    <div class="col-8 offset-2 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
      <div class="input-group mb-3">
      <input @keyup.enter="go" type="text" class="form-control" placeholder="Unesite oznaku" aria-label="Unesite tag" aria-describedby="basic-addon2" v-model="input">
      <div class="input-group-append">
        <a :href="'/oznaka/'+input" class="btn btn-outline-secondary rounded c2Button" type="button">Pretrаga</a>
      </div>
    </div>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      input : ""
    }
  },

  methods : {
    go(){
      window.location.href = '/oznaka/'+this.input;
    }
  }
}
</script>

<style lang="css">
</style>
