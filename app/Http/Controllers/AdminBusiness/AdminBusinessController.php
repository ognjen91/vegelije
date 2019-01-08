<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductGroup;
use App\Product;
use App\Suggestion;
use App\Traits\ImageWizzard;
use App\MainAd;
use App\SecondAd;

class AdminBusinessController extends Controller
{
      use ImageWizzard;


    public function index(){
      return view('admin.business.index');
    }

    public function indexAds(){
      $mainAds = MainAd::all();
      $secondAds = SecondAd::all();
      return view('admin.business.ads.index', compact('mainAds', 'secondAds'));
    }

    public function indexRecommended(){
      $products = Product::where('isRecommended', "1")->with('category', 'manufacturer')->get();
      return view('admin.business.showRecommended', compact('products'));
    }

    public function getCleaningForm(){
      $toDelete = self::toDelete();


      return view('admin.business.cleanImages', compact('toDelete'));
    }

    public function clean(Request $request){

      if($request->password !== \Auth::user()->password && $request->email !== \Auth::user()->email){
        return redirect()->back()->withError('Pogrešni podaci.');
      }

      $toDelete = self::toDelete();

      foreach ($toDelete as $nameOfImage) {
        self::deleteImage($nameOfImage);
      }
      // dd($toDelete);

      return redirect()->route('home')->withSuccess('Ocišćeno: obrisano '. count($toDelete). " slika!");
      // dd($filesInPublicFolder);
    }



  public function listImages($page = 1){
    if($page<1) $page = 1;
    $dir = public_path().'/images/';
    $filesInPublicFolder = scandir($dir);
    // izbacivanje assets foldera, .. i .
    $ignoreFiles = ['assets', '.', '..', 'pig.png', 'placeholder.png', 'logo.png'];

    foreach ($ignoreFiles as $toIgnore) {
      if (($key = array_search($toIgnore, $filesInPublicFolder)) !== false) {
        array_splice($filesInPublicFolder, $key, 1);
      }
    }
    $imagesOnPage = [];
    for($i=($page-1)*10; $i<($page*10); $i++){
      if(isset($filesInPublicFolder[$i])) $imagesOnPage[] = $filesInPublicFolder[$i];
    }

    $pages = intdiv(count($filesInPublicFolder),10) + 1;
    return view('admin.business.listImgs', compact('pages', 'imagesOnPage', 'page'));
  }

  public function deleteImages(Request $request){
     if(!request('toDelete')) return redirect()->back()->withError('Niste izabrali ni jednu sliku');
     foreach (request('toDelete') as $image) {
       self::deleteImage($image);
     }
     return redirect()->back()->withSuccess('Uspješno izbrisane');
  }



    private static function toDelete(){
      $filesNotToDelete = [];
      $dir = public_path().'/images/';
      $filesInPublicFolder = scandir($dir);

      // izbacivanje assets foldera, .. i .
      $ignoreFiles = ['assets', '.', '..', 'pig.png', 'placeholder.png', 'logo.png'];
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
      return $toDelete = array_diff($filesInPublicFolder, $filesNotToDelete); //za fju array_dif vazan je redoslijed argumenata

    }
}
