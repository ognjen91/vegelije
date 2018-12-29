<template lang="html">
 <div>
   <h4><strong>Proizvođač</strong></h4>
   <div class="form-group">
    <select name='manufacturer_id' class="form-control mb-4" id="exampleFormControlSelect1">
      <option value="nepoznato">Nepoznato</option>
      <option v-for="manufacturer in all" :value="manufacturer.id">{{manufacturer.name}}</option>
    </select>

    <h5>Proizvođača nema na listi? <a href="/manufacturer/new">Dodajte ga!</a></h5>
  </div>
 </div>
</template>

<script>
export default {
  props : ['all']
}
</script>

<style lang="css">
</style>
