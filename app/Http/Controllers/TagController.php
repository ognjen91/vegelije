<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
   public function index(){
     $tagsTotal = count(Tag::all());
     if($tagsTotal>100){
       $tagsToGet = (int)($tagsTotal/2);
     } elseif ($tagsTotal>200) {
       $tagsToGet = (int)($tagsTotal/3);
     } elseif ($tagsTotal>300) {
       $tagsToGet = 150;
     } else {
       $tagsToGet = $tagsTotal;
     }
     $tags = Tag::inRandomOrder()->take($tagsToGet)->get()->pluck('name');

     return view('guest.pages.tags', compact('tags'));
   }


    public function view($name = ''){

      $tag = Tag::where('name', $name)->first();
      if($tag){
        $products = $tag->products()->orderBy('name', 'asc')->with('manufacturer', 'category')->get();
        $productGroups = $tag->productGroups()->orderBy('name', 'asc')->with('category')->get();
        $tagName = $tag->name;
      } else {
        $tagName = $name;
        $products = collect([]);
        $productGroups = collect([]);
      }


      return view('guest.listingProducts.byTag', compact('tagName', 'products', 'productGroups'));
    }
}
