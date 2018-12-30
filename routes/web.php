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

//treba dodati midddleware
Route::get('/predlozite', 'SuggestionController@create')->name('suggestProduct');
Route::post('/predlozite', 'SuggestionController@store')->name('storeSuggestion');

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

Auth::routes();


Route::prefix('admin')->group(function () {
  Route::get('/', ['middleware'=>'roles', 'roles'=>['Admin', 'Moderator'], 'uses'=>'HomeController@index'])->name('home');
  Route::get('/letter/{letter?}', 'HomeController@index');
  Route::get('/create', 'HomeController@create')->name('newProduct');
  Route::get('/logout', 'HomeController@logout')->name('logout');



  // =====PRODUCT =========
  Route::get('/adminBussines', 'AdminBusinessController@index')->name('adminBussines');
  Route::get('/adminBussines/clearImagesFolder', 'AdminBusinessController@getCleaningForm')->name('cleanImagesFoldeForm');
  Route::post('/adminBussines/clearImagesFolder', 'AdminBusinessController@clean')->name('cleanImagesFolder');



  // Route::get('/product/create', 'ProductController@create')->name('newProduct');
  Route::post('/products', 'ProductController@store')->name('storeProduct');
  Route::get('/products/{id}/edit', 'ProductController@edit')->name('editProduct');
  Route::patch('/products/{product}', 'ProductController@update')->name('updateProduct');
  Route::delete('/products/{product}', 'ProductController@destroy')->name('deleteProduct');
  Route::get('/products/trash/{letter?}', 'ProductController@indexTrash')->name('trashedProducts');
  Route::post('/products/trash/{id}', 'ProductController@restore')->name('restoreProduct');
  Route::get('/products/{letter?}', 'ProductController@index')->name('products');

  // =====PRODUCT GROUPS=========
  // Route::get('/product_group/create', 'ProductGroupController@create')->name('newProductGroup');
  Route::post('/product_groups', 'ProductGroupController@store')->name('storeProductGroup');
  Route::get('/product_groups/{id}/edit', 'ProductGroupController@edit')->name('editProductGroup');
  Route::patch('/product_groups/{product}', 'ProductGroupController@update')->name('updateProductGroup');
  Route::delete('/product_groups/{product}', 'ProductGroupController@destroy')->name('deleteProductGroup');
  Route::get('/product_groups/trash/{letter?}', 'ProductGroupController@indexTrash')->name('trashedProductGroups');
  Route::post('/product_groups/trash/{id}', 'ProductGroupController@restore')->name('restoreProductGroup');
  Route::get('/product_groups/{letter?}', 'ProductGroupController@index')->name('productGroups');

  Route::get('/manufacturer/create', 'ManufacturerController@create')->name('createManufacturer');
  Route::get('/manufacturer/{manufacturer}/{letter?}', 'ManufacturerController@view')->name('manufacturerProducts');
  Route::post('/manufacturers', 'ManufacturerController@store')->name('storeManufacturer');
  Route::get('/manufacturers/{id}/edit', 'ManufacturerController@edit')->name('editManufacturer');
  Route::patch('/manufacturers/{manufacturer}', 'ManufacturerController@update')->name('updateManufacturer');
  Route::delete('/manufacturers/{manufacturer}', 'ManufacturerController@destroy')->name('deleteManufacturer');
  Route::get('/manufacturers/trash/{letter?}', 'ManufacturerController@indexTrash')->name('trashedManufacturers');
  Route::post('/manufacturers/trash/{id}', 'ManufacturerController@restore')->name('restoreManufacturer');
  Route::get('/manufacturers/{letter?}', 'ManufacturerController@index')->name('manufacturers');


  Route::get('/suggestions', 'SuggestionController@index')->name('suggestions');
  Route::get('/suggestions/trash', 'SuggestionController@indexTrash')->name('trashedSuggestions');
  Route::get('/suggestions/{id}/edit', 'SuggestionController@edit')->name('suggestionReview');
  Route::delete('/suggestions/{id}', 'SuggestionController@destroy')->name('deleteSuggestion');





  Route::get('/notifications', 'NotificationController@index')->name('notifications');
  Route::get('/notifications/unseen', 'NotificationController@index')->name('unseenNotifications')->defaults('type', 'seen');
  Route::get('/notifications/seen', 'NotificationController@index')->name('seenNotifications')->defaults('type', 'unSeen');
  Route::post('/notifications/{notification}/edit', 'NotificationController@edit')->name('changeNotificationStatus');


});
