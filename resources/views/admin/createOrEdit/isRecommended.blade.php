@if($user->hasRole('Admin'))
  <template slot='additional_content'>
    <div class="form-group mb-4">
      <label for="shouldSave"> <h5 class="c2 w-100">
        Da li je proizvod preporučen [==sponzorisan]?
      </h5>
    </label>

      <select class="form-control" name="isRecommended">
        <option value='0'>Ne</option>
        <option value='1'
        @edit @if(isset($product->isRecommended)) @if((int)$product->isRecommended ==1) selected @endif @endif
        @else @errors @if(old('isRecommended') == "1") selected @endif @enderrors @endedit>
          Da</option>
      </select>

      <input type="hidden" :value="suggestedBy" v-if="parseInt(shouldSave)" name="suggestedBy">
    </div>
  </template>
@endif
