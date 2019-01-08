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

         $lastProducts = Product::orderBy('created_at', 'desc')->get()->take(6);
         $lastProductGroups = ProductGroup::orderBy('created_at', 'desc')->get()->take(2);
         $lastProducts = $lastProducts->merge($lastProductGroups);

          $randomProducts =  Product::get()->random(4);
          $recommendedProductsCounter = Product::where('isRecommended', '1')->get()->count();
          if($recommendedProductsCounter){
            $products  = Product::where('isRecommended', '1')->inRandomOrder();
            $recommendedProducts = $recommendedProductsCounter >= 4? $products->take(4)->get() : ($recommendedProductsCounter == 3? $products->take(2)->get() : $products->get());
          }


          //ove podatke primam iz sesije koju sam setovao (ako je prethodno vrsena pretraga)  u ProductController@view
          $oldTerm = session('term');
          $oldManuf = session('manuf');
          session()->forget('term');
          session()->forget('manuf');

          // dd(session()->all());
          // dd($oldTerm);

          return view('welcome', compact('lastProducts', 'randomProducts', 'oldTerm', 'oldManuf', 'recommendedProducts', 'mainAd'));
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
