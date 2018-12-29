<template lang="html">
  <div class="form-group">
    <label :for="id"><h4><strong><slot name="selectTitle"></slot></strong></h4></label>
    <select class="form-control" :id="id" :name="name" v-model='value'>
      <slot name="default"></slot>
      <option v-for="something in all" :value="something.id" :key='something.id'>{{something.name}}</option>
    </select>
  </div>
</template>

<script>
export default {
  props: ['id', 'name', 'all', 'oldValue'],
  data(){
    return {
      value : 1
    }
  },

  mounted(){
    if (typeof this.oldValue !== 'undefined') this.value=this.oldValue;
  }
}
</script>

<style lang="css">
</style>
