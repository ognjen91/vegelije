<template lang="html">
  <div class="form-group mb-4">
    <label for="shouldSave">
    <h5 class="c2 w-100">
        <slot name='text'></slot>
    </h5>
  </label>

    <select class="form-control" name="shouldSaveSuggester" id="shouldSave" v-model="shouldSave">
      <option value=1>Da</option>
      <option value=0>Ne</option>
    </select>

    <div v-if="shouldSave">
        <slot name="proposerEmail" ></slot>
    </div>



    <input type="hidden" :value="suggestedBy" v-if="parseInt(shouldSave)" name="suggestedBy">
  </div>
</template>

<script>
export default {
  props: ['suggestedBy'],
  data(){
    return {
      shouldSave : 1
    }
  },

  watch : {
    shouldSave(val){
      // if(val)
    }
  }
}
</script>

<style lang="css">
</style>
