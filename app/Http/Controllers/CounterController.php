<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductGroup;

class CounterController extends Controller
{
    public function index(){

      $products = Product::orderBy('viewsCount', 'desc')->orderBy('name', 'asc')->with('manufacturer', 'category')->take(10)->get();
      $productGroups = ProductGroup::orderBy('viewsCount', 'desc')->orderBy('name', 'asc')->with('category')->take(10)->get();
      // dd($products);
      return view('guest.listingProducts.byViews', compact('products', 'productGroups'));
    }
}
