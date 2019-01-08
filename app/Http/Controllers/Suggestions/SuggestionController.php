<?php

namespace App\Http\Controllers;
use App\Http\Requests\SuggestProductRequest;
use App\Manufacturer;
use App\Suggestion;
use App\Notifications\NewSuggestionCreated;

use Illuminate\Http\Request;
use Socialite;

class SuggestionController extends Controller
{
  public function __construct()
{
        $this->middleware('auth', ['except' => ['create', 'store']]);
}

   public function index(){
     $products = Suggestion::orderBy('created_at', 'ASC')->paginate(15);
     return view('admin.listed.suggestions', compact('products'));
   }

    public function create(){
        session(['suggestionPageRedirectUrl' => route('suggestProduct')]);
        $googleUser = session('googleUser');
        $view = 'product';
        return view('guest.pages.suggest.suggestPageDispatcher', compact('googleUser', 'view'));
    }

    public function store(SuggestProductRequest $request){
      $validated = $request->validated();
       if (Suggestion::store($request)) return redirect()->route('suggestProduct')->withSuccess('Predlog je poslat! Hvala
       na izdvojenom vremenu.');
    }

   //ovdje je review sugestije
    public function edit($id){
      $suggestion = Suggestion::withTrashed()->find($id);
      if(!$suggestion) return redirect()->route('suggestions')->withSuccess('Predlog nije pronađen (u međuvremenu je prihvaćen)');
      //treba ukloniti notifikaciju...
      \DB::table('notifications')->where('type', NewSuggestionCreated::class)
                                  ->where('data', 'LIKE', '%"id":'.$suggestion->id.'%')
                                  ->where('type', NewSuggestionCreated::class)
                                  ->where('notifiable_id', \Auth::user()->id)
                                  ->update(
                                    ['read_at' => date("Y-m-d H:i:s")]
                                  );

      $similars = \App\Product::withSimilarName($suggestion->name);
      $suggestedManufacturer = Manufacturer::where('name', $suggestion->manufacturer)->first();
      $suggestedManufacturerId = $suggestedManufacturer? $suggestedManufacturer->id : 1;
      return view('admin.suggestionReview', compact('suggestion', 'suggestedManufacturerId', 'similars'));
    }

    public function destroy($id){
      Suggestion::destroy($id);
      return redirect()->route('suggestions')->withSuccess('Predlog odbačen.');
    }

    public function indexTrash(){
      $products  = Suggestion::onlyTrashed()->paginate(20);
      return view('admin.listed.suggestions', compact('products'));
    }
}
