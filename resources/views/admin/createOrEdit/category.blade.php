<custom-select :id='"productCategory"' :name="'category_id'" :all="{{$categories}}"
@errors
:old-value="`{{old('category_id')}}`"
@else
@edit :old-value="'{{$product->category_id}}'"@endedit
@enderrors>
<template slot='selectTitle'>Kategorija @edit{{isset($product->manufacturer_id)? "proizvoda" : "grupe proizvoda"}}@endedit</template>
</custom-select>
