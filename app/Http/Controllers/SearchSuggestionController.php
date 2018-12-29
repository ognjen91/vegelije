<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductGroup;

class SearchSuggestionController extends Controller
{


public function index(Request $request){

    $term = $request->term;

    //prvo, svi proizvodi koji pocinju na input
    $suggestions = array_merge(Product::where('name', 'like', $term."%")->pluck('name')->toArray(),
                               ProductGroup::where('name', 'like', $term."%")->pluck('name')->toArray());

   //ako je malo prijedloga, dodajem dodatne
  if(count($suggestions)<=8){
    $suggestions2 = array_merge(Product::where('name', 'like', '%'.$term."%")->where('name', 'NOT LIKE', $term."%")->pluck('name')->toArray(),
                                ProductGroup::where('name', 'like', '%'.$term."%")->where('name', 'NOT LIKE', $term."%")->pluck('name')->toArray()
                              );

    $additional_suggestions = [];
    foreach ($suggestions2 as $index=>$suggestion) {
          $sim = similar_text($suggestion, $term , $percentOfSimilarity);
          $additional_suggestions[$suggestion] = $percentOfSimilarity; //moram da imena stavim u key-eve da razlicita imena sa istim procentom slicnosti ne bi overrideovao
        }

        //ubac dodatnih prijedloga u glavni array prijedloga
        arsort($additional_suggestions);
        foreach ($additional_suggestions as $key => $value) {
          $suggestions[] = $key;
        }


     }
     //da vrati prvih 10 unikatnih rezultata
    $suggestions = array_slice(array_unique($suggestions), 0, 8);
    return $suggestions;


}

}
