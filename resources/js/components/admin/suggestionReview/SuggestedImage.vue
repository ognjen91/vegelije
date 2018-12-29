<template lang="html">
  <div class="row">
    <!-- trenutna slika -->
    <div class="col-12">
      <h4 class="fo1"><strong><slot name="title"></slot></strong></h4>
    </div>
    <div class="col-12 my-3">
      <img :src="'/images/' + image" alt=""  v-if="image">
      <h5 class="fo1" v-else>Korisnik nije ubacio ovu sliku</h5>
    </div>
   <!-- <h1>{{image && imageAccepted? "true" : "false"}}</h1> -->


    <!-- sluzi za provjeru da li je prihvacena slika - salje se samo ako jeste-->
    <input type="hidden" :name="acceptanceIndicatorName" value="1" v-if="imageAccepted && image">
    <!-- ako jeste prihvacena, ovim poljem saljem ime slike -->
    <input type="hidden" :name="acceptedImageFieldName" :value="image" v-if="imageAccepted && image">

  <!-- da li se prihvata poslata slika -->
<div class="col-12 my-3" v-if="image">
    <div class="form-check my-3">
      <input class="form-check-input" type="radio"  id="exampleRadios1"  :checked="imageAccepted" @change="imageAccepted=1">
      <label class="form-check-label" for="exampleRadios1">
       <h5 class="fo1"><slot name='acceptMsg'></slot></h5>
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio"  id="exampleRadios2" :checked="!imageAccepted"  @change="imageAccepted=0">
      <label class="form-check-label" for="exampleRadios2">
        <h5 class="fo1"><slot name="notAcceptMsg"></slot></h5>
      </label>
    </div>
</div>

<!-- ako se ne prihvata -->
<div class="col-12 my-3"  v-if='!imageAccepted && image'>
  <h5 class="fo1"><slot name='uploadOtherImgMsg'></slot></h5>
    <div class="custom-file">
        <input type="file" class="form-control-file" id="validatedCustomFile" :name="name">
       <!-- <input :name="name" type="file" class="custom-file-input" id="validatedCustomFile"> -->
  </div>
</div>

<!-- ako nije poslata sugestija slike -->
<div class="col-12 my-3"  v-if='!image'>
  <h5 class="fo1"><slot name='uploadOtherImgMsg'></slot></h5>
    <div class="custom-file">
      <input type="file" class="form-control-file" id="validatedCustomFile" :name="name">
       <!-- <input :name="name" type="file" class="custom-file-input" id="validatedCustomFile"> -->
  </div>
</div>

<hr class="my-2">
  </div>

</template>

<script>
export default {
  props : ['image' , 'name', 'acceptanceIndicatorName', 'acceptedImageFieldName'],
  data(){
    return{
      imageAccepted : this.image? 1 : 0
    }
  }
}
</script>

<style lang="css">
</style>
