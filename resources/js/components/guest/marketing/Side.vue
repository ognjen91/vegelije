<template lang="html">
  <div slot="content" id="secondSide"></div>
</template>

<script>
import {throttle} from 'lodash'
export default {



  mounted(){
    $("#secondSide").offset({top: $("#listing").offset().top});
    const listing = document.getElementById("listing")
    // let originalOffset = listing.offsetTop;
    // window.addEventListener('scroll', throttle(function(){
    //   window.scrollY >= originalOffset? bars.classList.add('sideFixedToTop') : bars.classList.remove('fixedToTop');
    //   if(window.innerWidth >= 768){
    //     $('.fixedToTop').length? $("#randomTags").animate({ top: $("#bars").height()+"px"}, 200 ) : $("#randomTags").css('top', 'initial');
    //   }
    //
    // }, 300))
  }
}
</script>

<style lang="css">
</style>
