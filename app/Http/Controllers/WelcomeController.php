<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductGroup;
use App\Tag;

class WelcomeController extends Controller
{
    public function index(){

         $lastProducts = Product::orderBy('created_at', 'desc')->get()->take(5);

         $lastProductGroups = ProductGroup::orderBy('created_at', 'desc')->get()->take(2);

         $randomProducts =  Product::get()->random(4);


          $lastProducts = $lastProducts->merge($lastProductGroups);

          //ove podatke primam iz sesije koju sam setovao (ako je prethodno vrsena pretraga)  u ProductController@view
          $oldTerm = session('term');
          $oldManuf = session('manuf');
          session()->forget('term');
          session()->forget('manuf');

          // dd(session()->all());
          // dd($oldTerm);

          return view('welcome', compact('lastProducts', 'randomProducts', 'oldTerm', 'oldManuf'));
    }


    public function about(){
      return view('guest.pages.o_nama');
    }
}
