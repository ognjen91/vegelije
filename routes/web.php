<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'WelcomeController@index')->name('homepage');

// =========autentifikacija gostiju============
Route::get('login/google', 'Auth\LoginController@redirectToProvider')->name('googleLogin');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('logoutUser', 'Auth\LoginController@logoutGoogleUser')->name('googleUserLogout');

Auth::routes();


// ==============MAIN========================
Route::get('/proizvod/{product}', 'ProductController@view')->name('checkProduct');
Route::get('/grupe_proizvoda', 'ProductGroupController@index')->name('guestListProductGroups');
Route::get('/grupe_proizvoda/{productGroup}', 'ProductGroupController@view')->name('checkProductGroup');
Route::get('/oznake', 'TagController@index')->name('listTags');
Route::get('/oznaka/{tag?}', 'TagController@view')->name('taggedProducts');
Route::get('/kategorija/{category}', 'CategoryController@view')->name('categoryProducts');
Route::get('/proizvodjaci', 'ManufacturerController@index')->name('guestListManufacturers');
Route::get('/proizvodjac/{manufacturer}', 'ManufacturerController@view')->name('manufacturerProductsGuest');
Route::get('/kategorije', 'CategoryController@index')->name('guestListCategories');
Route::post('/searchSuggestions', 'SearchSuggestionController@index')->name('productSuggestions');
Route::post('/search', 'SearchResultsController@index')->name('productResults');
Route::get('/top_liste', 'CounterController@index')->name('topLists');
Route::get('/o_nama', 'WelcomeController@about')->name('aboutUs');


// ============sugestije==============
Route::get('/predlozite/proizvodi', 'SuggestionController@create')->name('suggestProduct');
Route::get('/predlozite/promena/proizvod/{product}', 'ProductEditSuggestionController@create')->name('suggestEdit');
Route::get('/predlozite/promena/grupa/{productGroup}', 'ProductGroupEditSuggestionController@create')->name('suggestEditGroup');
Route::get('/predlozite/slike/{product}', 'ImageSuggestionController@create')->name('suggestImage');
Route::post('/predlozite/promena/proizvodi', 'SuggestionController@store')->name('storeSuggestion');
Route::post('/predlozite/promena/proizvod/{product}', 'ProductEditSuggestionController@store')->name('storeEditSuggestion');
Route::post('/predlozite/promena/grupa/{productGroup}', 'ProductGroupEditSuggestionController@store')->name('storeEditGroupSuggestion');
Route::post('/predlozite/slike/{product}', 'ImageSuggestionController@store')->name('storeImageSuggestion');



Route::prefix('admin')->group(function () {
    //dashboard
  Route::get('/', ['middleware'=>'roles', 'roles'=>['Admin', 'Moderator'], 'uses'=>'HomeController@index'])->name('home');
  Route::get('/letter/{letter?}', 'HomeController@index');
  // =====kreiranje proizvoda i grupa proizvoda, sve preko jedne dinamicne forme
  Route::get('/create', 'HomeController@create')->name('newProduct');


  // =====ADMIN BUSSINES =========
  Route::group(['prefix'=>'bussines', 'middleware'=>'roles', 'roles'=>['Admin']],function () {
  Route::get('', 'AdminBusinessController@index')->name('adminBussines');

  // =====ciscenje viska slika... ne bi trebalo da bude posla za ovo, ali neka stoji za svaki slucaj=====
  Route::get('/clearImagesFolder', 'AdminBusinessController@getCleaningForm')->name('cleanImagesFoldeForm');
  Route::post('/clearImagesFolder', 'AdminBusinessController@clean')->name('cleanImagesFolder');

  // =======listanje i brisanje svih slika u public folderu=====================
  Route::get('/images/{page?}', 'AdminBusinessController@listImages')->name('listImages');
  Route::post('/images', 'AdminBusinessController@deleteImages')->name('deleteImages');

  // ========modovi=========================
  Route::get('/addMod', 'ModController@create')->name('addModForm');
  Route::post('/addMod', 'ModController@store')->name('addMod');

  // ======prikaz preporucenih proizvoda===============
  Route::get('/showRecommended', 'AdminBusinessController@indexRecommended')->name('showRecommended');

  // ================ads==================
  Route::get('/ads', 'AdminBusinessController@indexAds')->name('ads');
  Route::get('/ads/main', 'MainAdController@create')->name('createMainAd');
  Route::post('/ads/main', 'MainAdController@store')->name('storeMainAd');
  Route::get('/ads/main/{mainAd}', 'MainAdController@edit')->name('editMainAd');
  Route::post('/ads/main/{mainAd}', 'MainAdController@update')->name('updateMainAd');
  Route::post('/ads/setActiveMain', 'MainAdController@setActive')->name('setMainAd');
  Route::delete('/ads/main/{mainAd}', 'MainAdController@destroy')->name('deleteMainAd');
  Route::get('/ads/second', 'SecondAdController@create')->name('createSecondAd');
  Route::post('/ads/second', 'SecondAdController@store')->name('storeSecondAd');
  Route::get('/ads/second/{secondAd}', 'SecondAdController@edit')->name('editSecondAd');
  Route::post('/ads/second/{secondAd}', 'SecondAdController@update')->name('updateSecondAd');
  Route::post('/ads/setActiveSecond', 'SecondAdController@setActive')->name('setSecondAd');
  Route::delete('/ads/second/{secondAd}', 'SecondAdController@destroy')->name('deleteSecondAd');
});

  // =========MODS BUSSINESS==========
  Route::get('/profile', 'ModController@edit')->name('profile');
  Route::post('/profile/{id}', 'ModController@update')->name('editProfile');


  // =======PRODUCTS===============
  Route::post('/products', 'ProductController@store')->name('storeProduct');
  Route::get('/products/{id}/edit', 'ProductController@edit')->name('editProduct');
  Route::patch('/products/{product}', 'ProductController@update')->name('updateProduct');
  Route::delete('/products/{product}', 'ProductController@destroy')->name('deleteProduct');
  Route::get('/products/trash/{letter?}', 'ProductController@indexTrash')->name('trashedProducts');
  Route::post('/products/trash/{id}', 'ProductController@restore')->name('restoreProduct');
  Route::get('/products/{letter?}', 'ProductController@index')->name('products');

  // =====PRODUCT GROUPS=========
  Route::post('/product_groups', 'ProductGroupController@store')->name('storeProductGroup');
  Route::get('/product_groups/{id}/edit', 'ProductGroupController@edit')->name('editProductGroup');
  Route::patch('/product_groups/{product}', 'ProductGroupController@update')->name('updateProductGroup');
  Route::delete('/product_groups/{product}', 'ProductGroupController@destroy')->name('deleteProductGroup');
  Route::get('/product_groups/trash/{letter?}', 'ProductGroupController@indexTrash')->name('trashedProductGroups');
  Route::post('/product_groups/trash/{id}', 'ProductGroupController@restore')->name('restoreProductGroup');
  Route::get('/product_groups/{letter?}', 'ProductGroupController@index')->name('productGroups');


  // =====MANUFACTURERS===============
  Route::get('/manufacturer/create', 'ManufacturerController@create')->name('createManufacturer');
  Route::get('/manufacturer/{manufacturer}/{letter?}', 'ManufacturerController@view')->name('manufacturerProducts');
  Route::post('/manufacturers', 'ManufacturerController@store')->name('storeManufacturer');
  Route::get('/manufacturers/{id}/edit', 'ManufacturerController@edit')->name('editManufacturer');
  Route::patch('/manufacturers/{manufacturer}', 'ManufacturerController@update')->name('updateManufacturer');
  Route::delete('/manufacturers/{manufacturer}', 'ManufacturerController@destroy')->name('deleteManufacturer');
  Route::get('/manufacturers/trash/{letter?}', 'ManufacturerController@indexTrash')->name('trashedManufacturers');
  Route::post('/manufacturers/trash/{id}', 'ManufacturerController@restore')->name('restoreManufacturer');
  Route::get('/manufacturers/{letter?}', 'ManufacturerController@index')->name('manufacturers');


  // =============IMAGES========================
  Route::post('/image', 'ImageController@store')->name('storeImages');
  Route::get('/images/{imageable_type}/{id}', 'ImageController@edit')->name('editImages');
  Route::delete('/images/{id}', 'ImageController@destroy')->name('deleteImage');
  // Route::patch('/products/{product}', 'ProductController@update')->name('updateProduct');
  // Route::delete('/products/{product}', 'ProductController@destroy')->name('deleteProduct');

  // ========SUGGESTIONS================
  Route::get('/suggestions', 'SuggestionController@index')->name('suggestions');
  Route::get('/suggestions/trash', 'SuggestionController@indexTrash')->name('trashedSuggestions');
  Route::get('/suggestions/{id}/edit', 'SuggestionController@edit')->name('suggestionReview');
  Route::delete('/suggestions/{id}', 'SuggestionController@destroy')->name('deleteSuggestion');

  Route::get('/imagesSuggestions', 'ImageSuggestionController@index')->name('imagesSuggestions');
  Route::get('/imagesSuggestions/{id}/edit', 'ImageSuggestionController@edit')->name('imagesSuggestionReview');
  Route::post('/imagesSuggestions/{id}', 'ImageSuggestionController@update')->name('proceedImagesSuggestion');

  Route::get('/editSuggestions', 'ProductEditSuggestionController@index')->name('productEditSuggestions');
  Route::get('/editSuggestions/{id}/edit', 'ProductEditSuggestionController@edit')->name('productEditSuggestionReview');
  Route::post('/editSuggestions/{id}', 'ProductEditSuggestionController@update')->name('proceedProductEditSuggestion');

  Route::get('/editGroupSuggestions', 'ProductGroupEditSuggestionController@index')->name('productGroupEditSuggestions');
  Route::get('/editGroupSuggestions/{id}/edit', 'ProductGroupEditSuggestionController@edit')->name('productGroupEditSuggestionReview');
  Route::post('/editGroupSuggestions/{id}', 'ProductGroupEditSuggestionController@update')->name('proceedProductGroupEditSuggestion');

  // =============NOTIFICATIONS============
  Route::get('/notifications', 'NotificationController@index')->name('notifications');
  Route::get('/notifications/unseen', 'NotificationController@index')->name('unseenNotifications')->defaults('type', 'seen');
  Route::get('/notifications/seen', 'NotificationController@index')->name('seenNotifications')->defaults('type', 'unSeen');
  Route::post('/notifications/{notification}/edit', 'NotificationController@edit')->name('changeNotificationStatus');



  Route::get('/logout', 'HomeController@logout')->name('logout');

});
