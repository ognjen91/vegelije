<!-- maxNoOfFields -> max broj polja za upload
name -> ime polja za upload
mustUploadMultiple -> opcionalni, kada je neophodno dodati [] na ime (name) -->

<template lang="html">
  <div class="col-12">
    <div class="row mb-3 mb-lg-4" v-for='n in noOfFields' v-if="n <= maxNoOfFields">
      <input type="file" :name="fieldsName">
    </div>


 <div class="row">
    <h5><i class="fas fa-plus-circle " @click="noOfFields++"></i> Dodajte još polja za upload</h5>
    <div class="errorMsg" v-if="noOfFields > maxNoOfFields && showErrorMsg">
      <slot name='errorMsg'></slot>
    </div>
</div>


  </div>
</template>

<script>
export default {
  props : ['maxNoOfFields', 'name', 'mustUploadMultiple'],
  data(){
    return {
      noOfFields :  1,
      showErrorMsg : false
    }
  },

  computed : {
    fieldsName(){
      return  this.maxNoOfFields>1 || this.mustUploadMultiple===true? this.name + "[]" : this.name;
    }
  },

  watch : {
    noOfFields(val){
      if(val > this.maxNoOfFields) {
        this.showErrorMsg = true;
        setTimeout(()=>{this.showErrorMsg = false}, 2000);
      }
    }
  }

}
</script>

<style lang="css">
.disabledClick{
  pointer-events: none;
  color : rgb(244, 188, 199) !improtant;
}

.errorMsg{
  position: fixed;
  top : 0;
  left: 0;
  z-index: 15;
  background-color: rgb(138, 72, 210);
  color : #fff;
  width: 100vw;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>
