<?php

namespace App\Http\Controllers;
use App\ProductGroup;
use App\Notifications\ProductGroupEditSuggestionCreated;
use App\ProductGroupEditSuggestion;

use Illuminate\Http\Request;

class ProductGroupEditSuggestionController extends Controller
{

  public function __construct()
{
        $this->middleware('auth', ['only' => ['edit']]);
}

    public function create(ProductGroup $productGroup){
      session(['suggestionPageRedirectUrl' => route('suggestEditGroup', $productGroup->id)]);
      $googleUser = session('googleUser');
      $view = 'editGroup';
      return view('guest.pages.suggest.suggestPageDispatcher', compact('googleUser', 'view', 'productGroup'));
    }


    // obrada yahteval
    public function store(Request $request, ProductGroup $productGroup){
      if(!$productGroup) return redirect()->back()->withError('Greška, proizvod za koji ste poslali predlog promene ne postoji');
        //VALIDACIJA REQUESTA... i provjera da li za ovaj proizvod ima vec dovoljno slika

       // $validated = $request->validated();

       if (ProductGroupEditSuggestion::store($request, $productGroup)) return redirect()->route('suggestEdit', $productGroup->id)
       ->withSuccess('Predlog za izmenu podataka proizvoda je poslat! Hvala na izdvojenom vremenu.');
    }

    public function edit($id){
      // $suggestion = ImageSuggestion::withTrashed()->find($id);
      $suggestion = ProductGroupEditSuggestion::find($id);
      if(!$suggestion) return redirect()->route('imagesSuggestions')->withSuccess('Predlog nije pronađen (u međuvremenu je obrađen)');
      //treba ukloniti notifikaciju...
   \DB::table('notifications')->where('type', ProductGroupEditSuggestionCreated::class)
                                  ->where('data', 'LIKE', '%"id":'.$suggestion->id.'%')
                                  ->where('notifiable_id', \Auth::user()->id)
                                  ->update(
                                    ['read_at' => date("Y-m-d H:i:s")]
                                  );


      return view('admin.productGroupEditSuggestionReview', compact('suggestion'));
    }

  }
