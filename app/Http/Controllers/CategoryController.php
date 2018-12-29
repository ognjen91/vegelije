<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller{

  public function index(){
    $categories = [];
    $cats = Category::all();
    foreach ($cats as $category) {
      $categories[$category->name]['NoOfProducts'] = count($category->products);
      $categories[$category->name]['NoOfProductGroups'] = count($category->productGroups);
    }
    // $categories = Category::get();
    return view('guest.pages.categories', compact('categories'));
  }

  public function view(Category $category){
    $products = $category->products()->orderBy('name', 'asc')->with('manufacturer', 'category')->get();
    $productGroups = $category->productGroups()->orderBy('name', 'asc')->with('category')->get();
    $categoryName = $category->name;

    return view('guest.listingProducts.byCategory', compact('categoryName', 'products', 'productGroups'));
  }
}
