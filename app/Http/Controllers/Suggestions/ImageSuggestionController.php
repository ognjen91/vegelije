<?php

namespace App\Http\Controllers;
use App\Product;
Use App\Image;
use App\ImageSuggestion;
use App\Notifications\ImageSuggestionCreated;
use App\Traits\ImageWizzard;
use App\Events\ImagesSuggestionProceeded;


use Illuminate\Http\Request;

class ImageSuggestionController extends Controller
{

  use ImageWizzard;

  public function __construct()
{
        $this->middleware('auth', ['except' => ['create', 'store']]);
}

 public function index(){
   $imagesSuggestions = ImageSuggestion::all();
   return view('admin.listed.imagesSuggestions', compact('imagesSuggestions'));
 }

 // forma za ubac predlozenih slika (za korisnika)
 public function create(Product $product){
     if($product->images->count() >= 4){
         $msg = 'Poštovani, već imamo dovoljno slika za proizvod '.$product->name .' proizvođača '. $product->manufacturer->name .".";
         $pageTitle = "Predložite sliku";
         return view('guest.pages.suggest.noSuggestionNeeded', compact('msg', 'pageTitle'));
     }

     session(['suggestionPageRedirectUrl' => route('suggestImage', $product->id)]);
     $googleUser = session('googleUser');
     $view = 'image';
     return view('guest.pages.suggest.suggestPageDispatcher', compact('googleUser', 'view', 'product'));
 }



 // obrada ubaca slika
 public function store(Request $request, Product $product){
     //VALIDACIJA REQUESTA... i provjera da li za ovaj proizvod ima vec dovoljno slika

    // $validated = $request->validated();
    if (ImageSuggestion::store($request, $product)) return redirect()->route('suggestProduct')->withSuccess('Predlog za izmenu slika je poslat! Hvala
    na izdvojenom vremenu.');
 }




//forma za prikaz predlozenih slika (admin)
 public function edit($id){
   // $suggestion = ImageSuggestion::withTrashed()->find($id);
   $suggestion = ImageSuggestion::find($id);
   if(!$suggestion) return redirect()->route('imagesSuggestions')->withSuccess('Predlog nije pronađen (u međuvremenu je obrađen)');
   //treba ukloniti notifikaciju...
   \DB::table('notifications')->where('type', ImageSuggestionCreated::class)
                               ->where('data', 'LIKE', '%"id":'.$suggestion->id.'%')
                               ->where('notifiable_id', \Auth::user()->id)
                               ->update(
                                 ['read_at' => date("Y-m-d H:i:s")]
                               );


   return view('admin.imagesSuggestionReview', compact('suggestion'));
 }




 //obrada zahteva (admin)
 public function update(Request $request, $id){
      // dd($request->all());

      $suggestion = ImageSuggestion::find($id);
      if(!$suggestion) return redirect()->route('welcome')->withSuccess('Zahtev je u međuvremenu obrađen');
      $productId = $suggestion->product->id;


      // dd($suggestion->product);
      event(new ImagesSuggestionProceeded($suggestion, $request->imagesAcceptedNames, $request->imagesRejectedNames, $request->profileImage));

      return redirect()->route('editProduct', $productId)->withSucces('Zahtev obrađen');
   }



}
