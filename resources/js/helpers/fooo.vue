<template lang="html">
  <div class="nesto">

    <h1>NESTO!!!</h1>
    <h2 v-for="(bool, name) in processed" :key="name">
      <span @click='fooo(name)'>{{name}}</span>
      <span v-if="bool">OK</span>
    </h2>

  </div>
</template>

<script>
export default {
  props : ['products'],
  data(){
    return{
      processed : {}
    }
  },
  methods : {
    fooo(name){
      this.processed[name] = !this.processed[name];
      console.log(this.processed[name]);
    }
  },

  mounted(){
      let prod = this.products;
      let proc = {};
      prod.forEach(pr=>proc[pr.name]=false);
      this.processed = proc;
  }
}
</script>

<style lang="css">
.nesto{
  width: 100vw;
  height: 100vh;
}
</style>
