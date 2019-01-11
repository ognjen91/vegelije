<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductGroup;
use App\Counter;
use App\Tag;
use App\Category;
use App\Manufacturer;
use App\MainAd;

class WelcomeController extends Controller
{
    public function index(){

         $products = Product::orderBy('created_at', 'desc')->get();
         $productGroups = ProductGroup::orderBy('created_at', 'desc')->get();

         $lastProducts = $products->count() > config('app.initial_no_of_new_products')? $products->take(config('app.initial_no_of_new_products')) : $products;
         $lastProductGroups = $productGroups->count() > config('app.initial_no_of_new_product_groups')? $productGroups->take(config('app.initial_no_of_new_product_groups')) : $productGroups;

         $lastProducts = $lastProducts->merge($lastProductGroups);

         $randomProducts =  $products->count() > config('app.initial_no_of_random_products')? Product::get()->random(config('app.initial_no_of_random_products')) : Product::get()->random($products->count());

          $recommendedProductsCounter = Product::where('isRecommended', '1')->get()->count();
          if($recommendedProductsCounter){
            $theProducts  = Product::where('isRecommended', '1')->inRandomOrder();
            $recommendedProducts = $recommendedProductsCounter >= config('app.initial_no_of_recom_products')? $theProducts->take(config('app.initial_no_of_recom_products'))->get() : $theProducts->take($recommendedProductsCounter)->get();
          }


          //ove podatke primam iz sesije koju sam setovao (ako je prethodno vrsena pretraga)  u ProductController@view
          $oldTerm = session('term');
          $oldManuf = session('manuf');
          session()->forget('term');
          session()->forget('manuf');

          // dd(session()->all());
          // dd($oldTerm);

          return view('welcome', compact('lastProducts', 'randomProducts', 'oldTerm', 'oldManuf', 'recommendedProducts'));
    }





    public function about(){
      $productViews = Counter::productsViews();
      $productGroupsViews = Counter::productGroupsViews();
      $noOfProducts = Product::all()->count();
      $noOfProductGroups = Product::all()->count();
      $noOfTags = Tag::all()->count();
      $noOfCategories = Category::all()->count();
      $noOfManufacturers = Manufacturer::all()->count();
      return view('guest.pages.o_nama', compact('productViews', 'productGroupsViews', 'noOfProducts', 'noOfProductGroups', 'noOfTags', 'noOfCategories', 'noOfManufacturers'));
    }
}
