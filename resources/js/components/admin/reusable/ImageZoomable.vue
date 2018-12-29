<template lang="html">
  <div class="zoomableImage">
    <img :src="imageSrc" alt="" @click="isZoomed = true">
    <div class="zoomedImage" :src="imageSrc" v-if='isZoomed'>
      <i class="fas fa-times-circle fa-2x closeImage" @click='isZoomed=false'></i>
      <img :id="imgId" class='zoomImg' :src="imageSrc" alt="">
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

}
</script>

<style lang="css" scoped>
.closeImage{
  position: absolute;
  top: 1%;
  right : 1%;
  color : #ffd400;
}

.zoomedImage{
  position: fixed;
  top: 0%;
  left: 0;
  width: 100vw;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: rgba(53, 64, 68, 0.53);
  z-index: 15;


}

.zoomedImage>img{
  width: 90%;
}

@media screen and (min-width: 768px){
  .zoomedImage>img{
    width: 75%;
  }
}

@media screen and (min-width: 992px){
  .zoomedImage>img{
    width: 60%;
  }
}
</style>
