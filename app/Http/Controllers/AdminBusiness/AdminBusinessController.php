<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductGroup;
use App\Product;
use App\Suggestion;
use App\Traits\ImageWizzard;
use App\ImageSuggestion;
use App\MainAd;
use App\SecondAd;
use App\Manufacturer;
use App\Image;

class AdminBusinessController extends Controller
{
      use ImageWizzard;

   // pocenta stranica admin bussines
    public function index(){
      return view('admin.business.index');
    }

    public function indexAds(){
      $mainAds = MainAd::all();
      $secondAds = SecondAd::all();
      return view('admin.business.ads.index', compact('mainAds', 'secondAds'));
    }

    //izlistavanje odabranih proizvoda
    public function indexRecommended(){
      $products = Product::where('isRecommended', "1")->with('category', 'manufacturer')->get();
      return view('admin.business.showRecommended', compact('products'));
    }

    // forma za ciscenje slika koje ne pripadaju ni jednom objektu
    public function getCleaningForm(){
      $toDelete = self::toDelete();
      return view('admin.business.cleanImages', compact('toDelete'));
    }

    //brisanje slika koje ne pripadaju ni jednom objektu
    public function clean(Request $request){
      if($request->password !== \Auth::user()->password && $request->email !== \Auth::user()->email){
        return redirect()->back()->withError('Pogrešni podaci.');
      }
      $toDelete = self::toDelete();
      foreach ($toDelete as $nameOfImage) {
        self::deleteImage($nameOfImage);
      }
      // dd($toDelete);

      return redirect()->route('adminBussines')->withSuccess('Ocišćeno: obrisano '. count($toDelete). " slika!");
      // dd($filesInPublicFolder);
    }




  //izlistavanje slika iz public/images foldera
  public function listImages($page = 1){
    if($page<1) $page = 1;
    $dir = public_path().'/images/';
    $filesInPublicFolder = scandir($dir);
    // izbacivanje assets foldera, .. i .drugih sa ignore liste
    $ignoreFiles = ['assets', '.', '..', 'pig.png', 'placeholder.png', 'logo.png', 'index.php'];
    foreach ($ignoreFiles as $toIgnore) {
      if (($key = array_search($toIgnore, $filesInPublicFolder)) !== false) {
        array_splice($filesInPublicFolder, $key, 1);
      }
    }

    $imagesOnPage['inImagesTable'] = $imagesOnPage['notInImagesTable'] = [];
    for($i=($page-1)*10; $i<($page*10); $i++){
      if(isset($filesInPublicFolder[$i])){
        $isInImagesTable = Image::where('name', $filesInPublicFolder[$i])->first()? "inImagesTable" : "notInImagesTable";
        $imagesOnPage[$isInImagesTable][] = $filesInPublicFolder[$i];
      }
    }
    // dd($imagesOnPage);
    $pages = intdiv(count($filesInPublicFolder),10) + 1;
    return view('admin.business.listImgs', compact('pages', 'imagesOnPage', 'page'));
  }




  //brisanje odabranih slika iz public/images foldera
  public function deleteImages(Request $request){
     if(!request('toDelete')) return redirect()->back()->withError('Niste izabrali ni jednu sliku');
     foreach (request('toDelete') as $image) {
       self::deleteImage($image);
     }
     return redirect()->back()->withSuccess('Uspješno izbrisane');
  }





    //izlistavanje slika koje ne pripadaju ni jednom objektu
    private static function toDelete(){
      $filesNotToDelete = [];
      $dir = public_path().'/images/';
      $filesInPublicFolder = scandir($dir);

      // izbacivanje assets foldera, .. i .
      $ignoreFiles = ['assets', '.', '..', 'pig.png', 'placeholder.png', 'logo.png', 'index.php'];
      foreach ($ignoreFiles as $toIgnore) {
        if (($key = array_search($toIgnore, $filesInPublicFolder)) !== false) {
          unset($filesInPublicFolder[$key]);
        }
      }
      // dd($filesInPublicFolder);
      $images = [];
      $collectionsOfObjectsWithImages = [Product::all(), ProductGroup::all(), Manufacturer::all(),
      Suggestion::all(), ImageSuggestion::all(), MainAd::all(),SecondAd::all()];

       foreach ($collectionsOfObjectsWithImages as $collection) {
         foreach ($collection as $object) {
           if($object->images->count()){
             foreach ($object->images as $image) {
               $images[] = $image->name;
             }
           }
         }
      }

      // dd($images);
      // dd(array_diff($filesInPublicFolder, $images));
      // dd($filesNotToDelete, $filesInPublicFolder);
      return $toDelete = array_diff($filesInPublicFolder, $images); //za fju array_dif vazan je redoslijed argumenata

    }
}
