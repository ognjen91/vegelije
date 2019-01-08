<template lang="html">
  <div :class='classOfDiv'>
    <transition enter-active-class="animated fadeIn"
                leave-active-class="animated fadeOut"
                mode="out-in"
                :duration='duration'>
    <div  v-if="visible">
        <slot name="entering" class="row" id="id"></slot>
    </div>
    </transition>
  </div>
</template>

<script>
import inView from 'in-viewport'
export default {
  props : ['classOfDiv', 'duration'],
  data(){
    return{
      id : 'slide' + Math.floor(Math.random() * 100) + 1,
      visible :  false
    }
  },

  methods : {
    doSlide(){
      setTimeout(()=>this.visible = true, 1500);
    }
  },
  mounted(){
    inView(this.$el, ()=>this.doSlide());

  }
  }

</script>

<style lang="css">
</style>
