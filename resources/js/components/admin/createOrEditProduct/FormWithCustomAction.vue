<!-- ova komponenta je napravljena da bih imao jedinstvenu formu za ubac product-a i producGroup-a -->
<template lang="html">

  <form :action="formParams.actionUrl" class="creationForm w-100" :class="{disabledForm : disableForm}" method="post" enctype="multipart/form-data" :id='formId'>

    <div class="disablingWindow" v-if='disableForm'></div>
    <slot name='token'></slot>

    <slot name="defaults"></slot>


    <slot  name="category"></slot>


   <!-- zbog buga moram ovako(inace polje ne moze da se mijenja...):  -->
    <div  v-if='formParams.isExactProduct'>
      <slot name="commentEditor"></slot>
    </div>
    <div  v-else>
      <slot name="commentEditor"></slot>
    </div>

    <div key='1' v-if='formParams.isExactProduct'>
      <slot  name="manufacturer"></slot>
    </div>



    <div  v-if='formParams.isExactProduct'>
      <slot  name="isVege"></slot>
    </div>



    <slot name='image'></slot>

    <div key='2' v-if='formParams.isExactProduct'>
      <slot  name='declarationImage'></slot>
    </div>

    <div v-if='formParams.isExactProduct'>
      <slot  name='selectGroups'></slot>
    </div>

    <slot name='tags'></slot>

    <div v-if='formParams.isExactProduct'>
    <slot name='additional_content'></slot>
    </div>



    <input type="submit" value="Prihvati" class='btn btn-primary btn-lg btn-block my-5'>





  </form>

</template>

<script>
export default {
  props : ['disableForm'],
  data(){
    return{
      formId : Math.floor(Math.random() * 10)
    }
  },
  methods : {
    submitForm(){
      $("#"+formId).submit();
    }
  },
  computed : {
    formParams(){
      return this.$store.getters.getStoreOrUpdateFormParams;
    }
  },

  mounted(){
    $("#selectingProductGroups").hide();
    $('body').on('click', '#showHideSelectingGroup', function() {
      $("#selectingProductGroups").slideToggle();
    });


  }
}
</script>

<style lang="css" scoped>
 .disabledForm{
   pointer-events: none;
   position:relative;
 }

 .disablingWindow{
   z-index: 4;
   position: absolute;
   background-color: rgba(232, 217, 211, 0.41);
   height: 100%;
   width: 100%;
 }
</style>
