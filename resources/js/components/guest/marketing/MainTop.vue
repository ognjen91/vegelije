<template lang="html">
  <div class="top periodicaly" v-if='shouldShow'>


    <a :href="'http://'+mainAd.link" class="frame mb-md-1">
      <span class="counter">{{closesIn}}
        <button type="button" class="close closeMainTop" aria-label="Close" @click="shouldShow=false">
          <i class="fas fa-times-circle  c1"></i>
        </button>
      </span>
      <img :src="'/images/'+mainAd.popupImage" alt="">
    </a>
  </div>
</template>

<script>
import {shouldShow} from './functions';
export default {
  props : ['mainAd'],
  data(){
    return{
      shouldShow : false,
      closesIn : +this.mainAd.intervalInSeconds
    }
  },


  mounted(){
    this.shouldShow = shouldShow(1);
    if(this.shouldShow){
      setTimeout(()=>
          this.shouldShow = false, +this.mainAd.intervalInSeconds*1000);
      setInterval(()=>this.closesIn--, 1000)
      }
  }
}
</script>

<style lang="css">
</style>
