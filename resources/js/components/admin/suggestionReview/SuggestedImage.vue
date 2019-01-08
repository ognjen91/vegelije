<template lang="html">
  <div class="row">
    <!-- trenutna slika -->
    <div class="col-12">
      <h4 class="fo1"><strong><slot name="title"></slot></strong></h4>
    </div>
    <div class="col-10 offset-1 col-md-8 offset-md-2 my-3">
      <div class="suggestedImage">
          <img  :src="'/images/' + image" alt=""  v-if="image">
      </div>
    </div>
   <!-- <h1>{{image && imageAccepted? "true" : "false"}}</h1> -->


    <!-- salje se samo ako jeste prihvacena sugestija-->
    <!-- ako jeste bar jedna prihvacena, ovim poljem saljem imena slika -->
    <input type="hidden" :name="acceptedImageFieldName" :value="image" v-if="imageAccepted && image">
    <input type="hidden" :name="rejectedImageFieldName" :value="image" v-if="!imageAccepted && image">


  <!-- da li se prihvata poslata slika (radiobuttoni)-->
<div class="col-12 my-3" v-if="image">
    <div class="form-check my-3">
      <input class="form-check-input" type="radio"  id="exampleRadios1"  :checked="imageAccepted" @change="imageAccepted=1">
      <label class="form-check-label" for="exampleRadios1">
       <h5 class="fo1"><slot name='acceptMsg'></slot></h5>
      </label>
    </div>
    <div class="pl-5 form-check my-3" v-if="imageAccepted">
      <input class="form-check-input" type="radio"  id="exampleRadios3"   name="profileImage" :value="image">
      <label class="form-check-label" for="exampleRadios3">
       <h6 class="fo1"><slot name='setProfile'></slot></h6>
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio"  id="exampleRadios2" :checked="!imageAccepted"  @change="imageAccepted=0">
      <label class="form-check-label" for="exampleRadios2">
        <h5 class="fo1"><slot name="notAcceptMsg"></slot></h5>
      </label>
    </div>
</div>


<hr class="my-2">
  </div>

</template>

<script>
export default {
  props : ['image' , 'name', 'acceptedImageFieldName', 'rejectedImageFieldName'],
  data(){
    return{
      imageAccepted : this.image? 1 : 0
    }
  }
}
</script>

<style lang="css">
</style>
