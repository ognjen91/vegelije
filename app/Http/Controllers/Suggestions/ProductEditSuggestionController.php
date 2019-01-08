<?php

namespace App\Http\Controllers;
use App\Product;
use App\Notifications\ProductEditSuggestionCreated;
use App\ProductEditSuggestion;

use Illuminate\Http\Request;

class ProductEditSuggestionController extends Controller
{

  public function __construct()
{
        $this->middleware('auth', ['only' => ['edit']]);
}


    public function create(Product $product){
      session(['suggestionPageRedirectUrl' => route('suggestEdit', $product->id)]);
      $googleUser = session('googleUser');
      $view = 'edit';
      return view('guest.pages.suggest.suggestPageDispatcher', compact('googleUser', 'view', 'product'));
    }


    // obrada yahteval
    public function store(Request $request, Product $product){
      if(!$product) return redirect()->back()->withError('Greška, proizvod za koji ste poslali predlog promene ne postoji');
        //VALIDACIJA REQUESTA... i provjera da li za ovaj proizvod ima vec dovoljno slika

       // $validated = $request->validated();

       if (ProductEditSuggestion::store($request, $product)) return redirect()->route('suggestEdit', $product->id)
       ->withSuccess('Predlog za izmenu podataka proizvoda je poslat! Hvala na izdvojenom vremenu.');
    }

    public function edit($id){
      // $suggestion = ImageSuggestion::withTrashed()->find($id);
      $suggestion = ProductEditSuggestion::find($id);
      if(!$suggestion) return redirect()->route('imagesSuggestions')->withSuccess('Predlog nije pronađen (u međuvremenu je obrađen)');
      //treba ukloniti notifikaciju...
   \DB::table('notifications')->where('type', ProductEditSuggestionCreated::class)
                                  ->where('data', 'LIKE', '%"id":'.$suggestion->id.'%')
                                  ->where('notifiable_id', \Auth::user()->id)
                                  ->update(
                                    ['read_at' => date("Y-m-d H:i:s")]
                                  );


      return view('admin.productEditSuggestionReview', compact('suggestion'));
    }

  }
