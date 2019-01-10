<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductGroup;
use App\Image;
use App\Traits\ImageWizzard;

class ImageController extends Controller
{



  use ImageWizzard;

  private static $imageables = ['Product', 'ProductGroup', 'Manufacturer', 'MainAd', 'SecondAd', 'Suggestion', 'ImageSuggestion'];
  private static $maxNoOfImages = ['Product'=>4, 'ProductGroup'=>4, 'Manufacturer'=>2, 'MainAd'=>4, 'SecondAd'=>4, 'Suggestion'=>2, 'ImageSuggestion'=>4];
  private static $serbianNameOfType = ['Product'=>'Proizvod', 'ProductGroup'=>'Grupa proizvoda',
                                      'Manufacturer'=>'Proizvođač','MainAd'=>'Glavna reklama', 'SecondAd'=>'Druga reklama',
                                      'Suggestion'=>'Predlog', 'ImageSuggestion'=>'Predlog slika'];



    public function __construct(){
    // $this->middleware('auth', ['except' => ['store']]);
    }

    public function edit(string $imageable_type, $id){
        if(!in_array($imageable_type, self::$imageables)) return redirect()->route('home')->withError('Pogrešna ruta');
        $className = 'App\\'.$imageable_type;
        $imageableObject = $className::withTrashed()->find($id);

        $maxNoOfImages = self::$maxNoOfImages[$imageable_type];
        $serbianNameOfType = self::$serbianNameOfType[$imageable_type];
        return view('admin.createOrEdit.images.menage', compact('imageableObject', 'imageable_type', 'maxNoOfImages', 'serbianNameOfType'));
    }




    public function store(Request $request){

      $rules = [
            'images.*'=> 'max:4000|mimes:jpg,jpeg,png'
        ];

      $messages = [
            'images.*.uploaded' => 'Jedna od slika je prevelika: maksimalna dozvoljena veličina slike iznosi 3,5MB. Molimo, pokušajte ponovo',
            'images.*.mimes' => 'Neodgovarajući format slike. Dozvoljeni formati su: jpg, jpeg, png'
      ];

        $this->validate($request, $rules, $messages);


      $className = 'App\\'.$request->imageable_type;
      $imageableObject = $className::withTrashed()->find($request->id);
      if(!$imageableObject) return redirect()->route('home')->withError('Greška pri uploadu slika: objekat nije pronađen');
      if($request->hasFile('images')){
          $stored =  self::storeMultipleImages($request, 'images', $imageableObject);
          if($stored) return redirect()->back()->withSuccess('Slike uspešno ažurirane.');
      }

      return redirect()->back();
    }



    public function destroy($id){
      $image = Image::find($id);
      if(!$image) return redirect()->back()->withError('Greška prilikom brisanja slike');
      $imageableClass = $image->imageable_type;
      $imageableObject = $imageableClass::find($image->imageable_id);
      if(!$imageableObject)  return redirect()->back()->withError('Greška prilikom brisanja slike');

      //provjera da li je profilna slika imageableObject-a ona koja se brise i ako jeste, daje joj se vrijednost placeholdera
      $nameOfImageToDelete = $image->name;
      if(isset($imageableObject->image)){
        if($imageableObject->image == $nameOfImageToDelete){
          $imageableObject->image = "placeholder.png";
          $imageableObject->save();
        }
      }


      if(Image::destroy($id)){
        return self::deleteImage($nameOfImageToDelete)? redirect()->back()->withSucces('Slika uspješno obrisana') : redirect()->back()->withError('Greška prilikom brisanja slike');
      }
      return redirect()->back()->withError('Greška prilikom brisanja slike');
    }
}
