<template lang="html">
  <div class="productOrProductGroup">

  <input v-if="editing" type="hidden" name='_method' value="PATCH">



<h4 class="fo1"><strong>Navedeni unos predstavlja:</strong></h4>

<select name="productOrProductGroup" id="productOrProductGroup" v-model="productOrProductGroup">
  <option value="product">Konkretan proizvod</option>
  <option value="productGroup">Grupu proizvoda</option>
</select>


</div>
</template>

<script>
export default {
  props : ['productOrProductGroup', 'editing', 'productId'],
  data(){
    return {
      isExactProduct : true,
      // productOrProductGroup : 'product'
    }
  },

  methods : {
    setFormParams(isExactProduct){
      this.isExactProduct = isExactProduct;
      this.$store.commit('setStoreOrUpdateFormParams', formData);
    }
},

computed : {
  formData(){
    return{
      actionUrl : this.formActionUrl,
      isExactProduct : this.isExactProduct,
      editingProduct : this.editing
    }
  },

  formActionUrl(){
    if (!this.editing){
      return this.isExactProduct? '/admin/products' : '/admin/product_groups';
    } else {
      return this.isExactProduct? '/admin/products/'+ this.productId : '/admin/product_groups/'+ this.productId;
    }
  }
},

mounted(){
  this.$store.commit('setStoreOrUpdateFormParams', this.formData);

},

watch : {
 productOrProductGroup(val){
   this.isExactProduct = (val == 'product');
   this.$store.commit('setStoreOrUpdateFormParams', this.formData);

 },
 formData(val){
   // console.log(this.oldValue);
   console.clear();
 }
}


}
</script>

<style lang="css">
.productOrProductGroup{
  border: 1px solid rgb(135, 232, 99);
}
</style>
