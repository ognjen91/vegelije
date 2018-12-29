<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductGroup;
use App\Product;
use App\Suggestion;
use App\Traits\ImageWizzard;

class AdminBusinessController extends Controller
{
      use ImageWizzard;


    public function index(){
      return view('admin.business.index');
    }

    public function getCleaningForm(){
      return view('admin.business.cleanImages');
    }

    public function clean(){
      $filesNotToDelete = [];
      $dir = public_path().'/images/';
      $filesInPublicFolder = scandir($dir);

      // izbacivanje assets foldera, .. i .
      $ignoreFiles = ['assets', '.', '..', 'pig.png', 'placeholder.png'];
      foreach ($ignoreFiles as $toIgnore) {
        if (($key = array_search($toIgnore, $filesInPublicFolder)) !== false) {
          unset($filesInPublicFolder[$key]);
        }
      }
      // dd($filesInPublicFolder);
      // dd($ignoreFiles);

      $productImages = Product::select('image', 'declarationImage')->withTrashed()->get();
      $images = $productImages->pluck('image')->toArray();
      $declarationImages = $productImages->pluck('declarationImage')->toArray();
      // ciscenje od null
      $declarationImages  = array_filter($declarationImages);
      $allImages = array_merge($images, $declarationImages);

      foreach ($allImages as $image) {
        if($image !== 'placeholder.png') $filesNotToDelete[] = $image;
      }

      $productGroupImages = ProductGroup::select('image')->withTrashed()->get()->pluck('image')->toArray();
      foreach ($productGroupImages as $image) {
        if($image !== 'placeholder.png') $filesNotToDelete[] = $image;
      }

      $suggestionImages = Suggestion::select('image', 'declarationImage')->withTrashed()->get();
      $images = $suggestionImages->pluck('image')->toArray();
      $declarationImages = $suggestionImages->pluck('declarationImage')->toArray();
      // ciscenje od null
      $declarationImages  = array_filter($declarationImages);
      $allImages = array_merge($images, $declarationImages);

      foreach ($allImages as $image) {
        if($image !== 'placeholder.png') $filesNotToDelete[] = $image;
      }


      // dd($filesNotToDelete, $filesInPublicFolder);
      $toDelete = array_diff($filesInPublicFolder, $filesNotToDelete); //za fju array_dif vazan je redoslijed argumenata

      foreach ($toDelete as $nameOfImage) {
        self::deleteImage($nameOfImage);
      }
      // dd($toDelete);

      return redirect()->route('home')->withSuccess('Ocišćeno!');
      // dd($filesInPublicFolder);
    }
}
