<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductGroup;

class SearchResultsController extends Controller
{
    public function index(Request $request)
    {
        $results = ['exact'=>[], 'other'=>[]];
        $request->product = trim($request->product);
        $request->manufacturer = trim($request->manufacturer);

        // $ignoreList = ['od', 'sa', 'bez', 'ukusom'];

        //OVO CU MOCI ISKORISTITI I ZA PROVJERU DA LI UNOS VEC POSTOJI
        //rezultati prvog reda: oni koji tacno zadovoljavaju unose za proizvod i proizvodjaca
        if ($request->manufacturer) {

            $product = Product::select('id','name','image', 'manufacturer_id', 'category_id')->whereHas('manufacturer', function ($query) use ($request){
                            $query->where('name', $request->manufacturer);
                          })->where('name', $request->product)->with('manufacturer', 'tags', 'category')->first();
            if($product) $results['exact'][] = $product;
        } else {

            $products = Product::select('id','name','image', 'manufacturer_id', 'category_id')->where('name',  $request->product)->with('manufacturer', 'tags', 'category')->get();
            $productGroups = ProductGroup::select('id','name','image', 'category_id')->where('name',  $request->product)->with('tags', 'category')->get();
            if($products){
              foreach ($products as $product) {
                $results['exact'][] = $product;
              }
            }
            if($productGroups){
              foreach ($productGroups as $product) {
                $results['exact'][] = $product;
              }
            }
        }

        //rezultati drugog reda: isto ime proizvoda, proizvdjac nije vazan
        $products = Product::select('id','name','image', 'manufacturer_id', 'category_id')->where('name', $request->product)->with('manufacturer', 'tags', 'category')->get();
        $productGroups = ProductGroup::select('id','name','image', 'category_id')->where('name', $request->product)->with('tags', 'category')->get();
        if($products){
          foreach ($products as $product) {
             if(!in_array($product['exact'], $results)) $results['other'][] = $product;
          }
        }
        if($productGroups){
          foreach ($productGroups as $product) {
             if(!in_array($product['exact'], $results)) $results['other'][] = $product;
          }
        }

        //ostali rezultati koji imaju neku slicnost... poredjani po koef slicnosti...
        $products = Product::select('id','name','image', 'manufacturer_id', 'category_id')->with('manufacturer', 'tags', 'category')->get();
        $productGroups = ProductGroup::select('id','name','image', 'category_id')->with('tags', 'category')->get();

        $helper = [];
        foreach ($products as $product) {
          $sim = similar_text($request->product, $product->name , $percentOfSimilarity);
          if($percentOfSimilarity>=50 && !in_array($product, $results['exact']) && !in_array($product, $results['other'])) $helper[$percentOfSimilarity][] = $product;
        }
        foreach ($productGroups as $product) {
          $sim = similar_text($request->product, $product->name , $percentOfSimilarity);
          if($percentOfSimilarity>=50 && !in_array($product, $results['exact']) && !in_array($product, $results['other'])) $helper[$percentOfSimilarity][] = $product;
        }

        // sortiranje po koef slicnosti, prvo sa najvecim
        krsort($helper);
        foreach ($helper as $percentOfSimilarity => $resultsArray) {
          foreach ($resultsArray as $key => $value) {
            $results['other'][] = $value;
          }
        }

        // ili, ako samo sadrze trazenu rijec, dodacu na kraju
        foreach ($products as $product) {
          $containsSearchTerm = strpos($product->name, $request->product) !== false;
          if($containsSearchTerm && !in_array($product, $results['exact']) && !in_array($product, $results['other'])) $results['other'][] = $value = $product;
        }
        foreach ($productGroups as $product) {
          $containsSearchTerm = strpos($product->name, $request->product) !== false;
          if($containsSearchTerm && !in_array($product, $results['exact']) && !in_array($product, $results['other'])) $results['other'][] = $value = $product;
        }

        return $results;
    }
}
