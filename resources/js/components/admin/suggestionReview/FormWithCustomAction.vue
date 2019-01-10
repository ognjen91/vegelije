<!-- ova komponenta je napravljena da bih imao jedinstvenu formu za ubac product-a i producGroup-a -->
<template lang="html">

  <form :action="actionUrl" method="post" enctype="multipart/form-data" id="suggestionForm" @submit.prevent>

    <div class="col-12 alert alert-info p-3 mb-4" v-if='alreadyDeleted'>
      <h3 class="text-center">Ovaj predlog je već obrađen i nije prihvaćen. Ipak, i dalje je moguće prihvatiti ga.</h3>
    </div>


    <p class="c1" @click="showSimilars = !showSimilars"><strong>
      <span class="text-danger">Pronađeni su proizvodi/grupe sa sličnim imenom.</span> Prikaži ili sakrij klikom na strelicu
      <i class="fas " :class="{'fa-chevron-up': !showSimilars, 'fa-chevron-down': showSimilars}"></i>
    </strong></p>
     <div v-if="showSimilars">
       <slot name='similars'></slot>
     </div>



    <slot name='token'></slot>








    <slot name="defaults"></slot>

    <div v-if='isExactProduct'>
      <slot name="manufacturer" ></slot>
    </div>

    <div  v-if='isExactProduct'>
      <slot  name="isVege"></slot>
    </div>


      <slot  name="category"></slot>


    <slot name="commentEditor"></slot>

    <slot name='image'></slot>

    <div v-if='isExactProduct'>
      <slot name='declarationImage' v-if='isExactProduct'></slot>
    </div>

    <div v-if='isExactProduct'>
      <slot  name='selectGroups'></slot>
    </div>

    <slot name='tags'></slot>

    <slot name='additional'></slot>

    <input type="hidden" name="isFromSuggestion" value="1">
    <input type="hidden" name='suggestionAccepted' :value='suggestionAccepted'>
    <input type="hidden" name="suggestionId" :value="suggestionId">

  <div class="btn-group my-4" role="group" aria-label="Basic example">
  <button type="submit" class="btn btn-success btn-lg m-3" @click.prevent='submitForm(1)'>Prihvati <span v-if='alreadyDeleted'>prethodno odbačen</span> predlog</button>
  <button type="submit" class="btn btn-danger btn-lg m-3" @click.prevent='submitForm(0)' v-if="!alreadyDeleted">Odbaci</button>

  </div>

  </form>
</template>

<script>
export default {
  props : ['suggestionId', 'alreadyDeleted'],
  data(){
    return{
      suggestionAccepted : 1,
      showSimilars : 0

    }
  },
  methods : {
    submitForm(isSugestionAccepted){
      this.suggestionAccepted = isSugestionAccepted;
      setTimeout(function(){
        $('#suggestionForm').submit();
      }, 500);

    }
  },
  computed : {
    actionUrl(){
      return this.$store.getters.getStoreOrUpdateFormParams.actionUrl;
    },
    isExactProduct(){
      return this.$store.getters.getStoreOrUpdateFormParams.isExactProduct;
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

<style lang="css">
</style>
