<template lang="html">
  <div class="form-group">
   <label :for="id"><h4><slot name="inputTitle"></slot></h4></label>
   <input :type="type" :name="name" class="form-control" :id="id" placeholder="Upišite naziv..." v-model='value' :required='required' >
   <small class="form-text text-muted"><slot name="inputMessage"></slot></small>
 </div>
</template>

<script>
export default {
  props : ['id', 'name', 'type', 'oldValue', 'required'],
  data(){
    return {
      value : ""
    }
  },

    mounted(){
      if (typeof this.oldValue !== 'undefined') this.value=this.oldValue;
    }

}
</script>

<style lang="css">
</style>
