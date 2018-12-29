<template lang="html">
  <div>
    <i :class='iconClass' @click='submitForm'></i>


    <form :action="formAction" enctype="multipart/form-data" method="post" :id="'form-'+formId">
      <slot name='token'></slot>
      <slot name="method"></slot>
      <!-- <input type="submit" class="hiddenSubmit"> -->
    </form>
  </div>
</template>

<script>
export default {
  props : ['iconClass', 'formAction'],
  data(){
    return {
      formId : Math.floor(Math.random() * 1000000) + 1
    }
  },
  methods : {
    submitForm(){
      console.log(document.getElementById("form-"+this.formId));
      document.getElementById('form-'+this.formId).submit();
    }
  },
  computed : {

  }
}
</script>

<style lang="css">
</style>
