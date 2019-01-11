<template lang="html">
  <div class="zoomableImage">
    <img :src="imageSrc" alt="" @click="isZoomed = true">
    <div class="zoomedImage"  :src="imageSrc" v-if='isZoomed'>
        <i class="fas fa-times-circle fa-2x closeImage" @click='isZoomed=false'></i>
      <div>
        <img :id="imgId" :class="{'zoomedNow':isZoomed}" class='zoomImg' :src="imageSrc" alt="">
      </div>
    </div>
  </div>

</template>

<script>
export default {
  props : ["imageSrc"],
  data(){
    return{
      isZoomed : false
    }
  },
  computed: {
    imgId(){
      return Math.floor(Math.random() * 100000) + 1;
    }
  },
  mounted(){
    // ======zatvaranje klikom bilo gdje sem na sliku=============
    $(window).click(()=> {if($("#"+this.imgId+".zoomedNow").length) this.isZoomed=false});
    $('body').on('click', "#"+this.imgId+".zoomedNow", (e)=>e.stopPropagation());
}
  }


</script>

<style lang="css" scoped>
.zoomedImage{
  position: fixed;
  top: 0%;
  left: 0;
  width: 100vw;
  height: 100vh;
  background-color: rgba(53, 64, 68, 0.53);
  z-index: 15;
}
/* ..ostatak stilova za zoomedImage je u sassu */
.closeImage{
  position: absolute;
  top: 1%;
  right : 1%;
  color : #ffd400;
}


@media screen and (min-width: 768px){
  .closeImage{
    right: 2%;
  }
}

@media screen and (min-width: 992px){

  .closeImage{
    right: 3%;
  }
}

</style>
