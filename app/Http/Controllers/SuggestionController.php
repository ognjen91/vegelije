<?php

namespace App\Http\Controllers;
use App\Http\Requests\SuggestProductRequest;
use App\Manufacturer;
use App\Suggestion;

use Illuminate\Http\Request;

class SuggestionController extends Controller
{

   public function index(){
     $products = Suggestion::orderBy('created_at', 'ASC')->paginate(15);
     return view('admin.listed.suggestions', compact('products'));
   }

    public function create(){
        return view('guest.pages.suggestProduct');
    }

    public function store(SuggestProductRequest $request){
      $validated = $request->validated();
       if (Suggestion::store($request)) return redirect()->route('suggestProduct')->withSuccess('Sugestija je poslata! Hvala
       na izdvojenom vremenu.');
    }

   //ovdje je review sugestije
    public function edit($id){
      $suggestion = Suggestion::withTrashed()->find($id);
      if(!$suggestion) return redirect()->route('suggestions')->withSuccess('Predlog nije pronađen (u međuvremenu je prihvaćen)');
      //treba ukloniti notifikaciju...
      foreach (\Auth::user()->notifications as $notification) {
        if($notification->type == 'App\Notifications\NewSuggestionCreated'){
        if($notification->data['id'] == $suggestion->id) $notification->markAsRead();
        }
      }

      $suggestedManufacturer = Manufacturer::where('name', $suggestion->manufacturer)->first();
      $suggestedManufacturerId = $suggestedManufacturer? $suggestedManufacturer->id : 1;
      return view('admin.suggestionReview', compact('suggestion', 'suggestedManufacturerId'));
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
