<!-- Maskirana forma za brisanje pojedinog elementa
za unesni token, url i ime elementa za brisanje, izbacuje popup za potvrdu -->

<template lang="html">
<div>
  <!-- <i class="far fa-trash-alt" @click.prevent="showWarning = !showWarning"></i> -->
  <button :class="button" @click.prevent="showWarning = !showWarning">
    <slot name="buttonText"></slot>
  </button>

  <form method="post" :action="url" :id='formId' @submit.prevent>
    <slot name='token'></slot>
    <input type="hidden" name="_method" value="DELETE" v-if="method=='delete'">
    <input type="hidden" name="_method" value="PATCH" v-if="method=='patch'">
  </form>


  <!-- UPOZORENJE -->
  <div class="deleteWarning row" v-if="showWarning">
    <div class="deleteWarningHolder col-8 pt-2 pt-md-3">

      <div class="row mb-2">
        <div class="col-12">
          <h4 class="text text-center"><strong>
            <slot name="msg"></slot> {{targetItemName}} ?</strong></h4>
        </div>
      </div>

     <div class="warnOptions row d-flex justify-content-center">
          <button class="btn btn-primary col-4 m-1 m-md-2" @click="formProceed">DA</button>
          <button class="btn btn-secondary col-4 m-1 m-md-2" @click.prevent="showWarning = !showWarning">NE</button>
     </div>

  </div>

  </div>
</div>
</template>


<script>
export default {
    props : ['url', 'targetItemName', 'button', 'method'],
    data() {
        return {
            showWarning: false,
            token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')

        }
    },
    methods: {
        formProceed() {
            document.getElementById(this.formId).submit();
        }
    },
    computed: {
        formId() {
            return "delete_" + this.whatToDelete + Math.floor(Math.random() * 10);
        }
    },


}
</script>

<style lang="css">

.deleteWarning {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background-color: rgba(73, 74, 61, 0.22);
  display : flex;
  justify-content: center;
  align-items: center;
  /* padding-top: 15%; */



}

.deleteWarning{
  z-index: 1000;
}

.deleteWarningHolder{
  width: 70%;
  background-color: #fff;
  max-height: 50%;
  /* @medi-screen and (min-width : 992px){
    max-height: 35%;
  } */
  padding: 5%;


}


</style>
