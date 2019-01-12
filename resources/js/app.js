import Vue from 'vue';
import Vuex from 'vuex'
import storeData from './store'

Vue.use(Vuex);

require('./bootstrap');
window.Vue = require('vue');

Vue.component('productBar', require('./components/guest/ProductBar.vue'));
Vue.component('productSuggestions', require('./components/guest/SearchSuggestions.vue'));
Vue.component('manufacturerBar', require('./components/guest/ManufacturersBar.vue'));
Vue.component('manufacturerSuggestions', require('./components/guest/ManufacturersSuggestions.vue'));
Vue.component('searchResults', require('./components/guest/SearchResults.vue'));
Vue.component('searchResult', require('./components/guest/Product.vue'));
Vue.component('searchButton', require('./components/guest/SearchButton.vue'));
Vue.component('noProductDanger', require('./components/guest/NoProductDanger.vue'));
Vue.component('listingProductsAndProductGroups', require('./components/guest/listing.vue'));
Vue.component('listingTopProductsAndProductGroups', require('./components/guest/listingTop.vue'));
Vue.component('tagInput', require('./components/guest/tagInput.vue'));
Vue.component('manufacturersSearch', require('./components/guest/ManufacturersPageSearchBar.vue'));
Vue.component('manufacturersResults', require('./components/guest/ManufacturersPageResults.vue'));
Vue.component('beMentioned', require('./components/guest/DoesWantToBeMentioned.vue'));
Vue.component('marketMainTop', require('./components/guest/marketing/MainTop.vue'));
Vue.component('marketSide', require('./components/guest/marketing/Side.vue'));
Vue.component('slideInView', require('./components/guest/slidingInView.vue'));

Vue.component('productOrProductGroup', require('./components/admin/createOrEditProduct/ProductOrProductGroup.vue'));
Vue.component('productFormWithCustomAction', require('./components/admin/createOrEditProduct/FormWithCustomAction.vue'));
Vue.component('productManufacturer', require('./components/admin/createOrEditProduct/ProductManufacturer.vue'));

Vue.component('customInput', require('./components/admin/reusable/customInput.vue'));
Vue.component('customSelect', require('./components/admin/reusable/customSelect.vue'));
Vue.component('addTags', require('./components/admin/reusable/AddTags.vue'));
Vue.component('iconWarningAndAction', require('./components/admin/reusable/IconWarningAndAction.vue'));
Vue.component('buttonWarningAndAction', require('./components/admin/reusable/ButtonWarningAndAction.vue'));
Vue.component('iconWithHiddenForm', require('./components/admin/reusable/IconWithHiddenForm.vue'));
Vue.component('zoomableImage', require('./components/admin/reusable/ImageZoomable.vue'));
Vue.component('multipleInputFiles', require('./components/admin/reusable/multipleInputFiles.vue'));



Vue.component('suggestionFormWithCustomAction', require('./components/admin/suggestionReview/FormWithCustomAction.vue'));
Vue.component('suggestionProductOrProductGroup', require('./components/admin/suggestionReview/ProductOrProductGroup.vue'));
Vue.component('suggestedImage', require('./components/admin/suggestionReview/SuggestedImage.vue'));

Vue.component('notificationIconAndWindow', require('./components/admin/notificationWindow/IconAndWindow.vue'))


const store = new Vuex.Store(storeData);
const app = new Vue({
    el: '#app',
    store,
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$("#hamburger").click(()=>{$("#menu").removeClass("mobileMenuHide").addClass("mobileMenuShow")})
$("#closeMenu").click(()=>{$("#menu").removeClass("mobileMenuShow").addClass("mobileMenuHide")})

if($('#notice').length) setTimeout(()=>$('#notice').slideUp(), 5500);


if (process.env.MIX_APP_ENV === 'production') {
    Vue.config.devtools = false;
    Vue.config.debug = false;
    Vue.config.silent = true;
}
