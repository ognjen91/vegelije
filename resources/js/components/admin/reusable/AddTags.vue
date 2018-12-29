<template lang="html">
  <div class="">


      <h4 class="c2"><strong>Tagovi</strong>: unesite u kliknite "Dodaj tag"</h4>
      <h6 class="mb-3 c2">Možete dodati neograničen broj tagova</h6>
      <input type="text" v-model="newTag" class='rounded mr-1'>
      <div class="btn btn-secondary mb-2" name="button"  @click="addTag">Dodaj tag</div>

      <div class="col-12 alert alert-danger rounded" id='existingTagDanger' v-if='showExistingTagDanger'>
        <h5 class="text-center">Ovaj tag je vеć unet</h5>
      </div>



   <div class="col-12 m-4 suggestionTags">
    <div v-for="(tag, i) in tags" class="btn btn-primary c2Button suggestionTag mr-3 mb-1">
        {{tag}}
        <div class="tagRemove px-2 circle text-bold" @click="removeTag(i)">X</div>
    </div>
  </div>

    <!-- =========SLANJE TAGOVA================== -->
    <!-- sada cu pomocu sakrivene komponente da posaljem sve tagove -->
    <input required type="hidden" name="tags" v-model='tags'>


  </div>
</template>

<script>
export default {
  props: ['oldValue'],
  data(){
    return {
      newTag : "",
      tags : [],
      showExistingTagDanger : false
    }
  },

  methods : {
    addTag(){
      for (var i in this.tags){
        if (this.newTag === this.tags[i]){
            this.showExistingTagDanger = true;
            setTimeout(()=>{
              this.showExistingTagDanger = false;
            }, 1300);
            return;
        };
      }
      this.tags = [this.newTag, ...this.tags];
      this.newTag = "";
      this.showExistingTagDanger = false;
    },

    removeTag(i){
      this.tags.splice(i, 1);
    }
  },

  mounted(){
    console.log(this.oldValue.split(","));
    if (typeof this.oldValue !== 'undefined' && this.oldValue !== '') this.tags = this.oldValue.split(",");
  }
}
</script>

<style lang="css">

</style>
