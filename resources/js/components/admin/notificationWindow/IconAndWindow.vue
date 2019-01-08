<template lang="html">
 <div>
   <div class='notificationIcon'>
     <i class="fas fa-bell fa-2x" :class='{hasNewNotifications : noOfUnreadNotifications, hasNoNewNotifications : !noOfUnreadNotifications}' @click="windowShown = !windowShown"></i>
     <p class="fo1" v-if='noOfUnreadNotifications'><strong>[{{noOfUnreadNotifications}}]</strong></p>
   </div>

   <transition enter-active-class="animated bounceIn"
               leave-active-class="animated bounceOut"
               mode="out-in"
               duration='300'>
   <div class="allNotifications"  v-if='windowShown'>

     <template v-if='totalNoOfNotifications'>

     <!-- ako ima neprocitanih, prvo neprocitane pa procitane -->
     <template v-if='noOfUnreadNotifications'>
     <h5 class="text-center"><strong>Nove notifikacije</strong></h5>
     <slot name='unreadNotifications'></slot>
     <h5 class="text-center" v-if="totalNoOfNotifications - noOfUnreadNotifications"><strong>Ostale notifikacije</strong></h5>
     <slot name="readNotifications"  v-if="totalNoOfNotifications - noOfUnreadNotifications"></slot>
     </template>

     <!-- ako nema neprocitanih, onda samo procitane (=sve) -->
     <template v-else>
       <h5 class="text-center"><strong>Sve notifikacije</strong></h5>
        <slot name='readNotifications'></slot>
     </template>
   </template>

    <template v-else>
      <h5 class="text-center">Nemate ni jednu notifikaciju.</h5>
    </template>


   </div>
   </transition>

 </div>
</template>

<script>
export default {
  props : ['noOfUnreadNotifications', 'totalNoOfNotifications'],
  data(){
    return {
      windowShown : false
    }
  }
}
</script>

<style lang="css">
</style>
