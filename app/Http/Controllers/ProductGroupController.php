<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductGroup;
use App\Http\Requests\StoreProductGroupRequest;
use App\Http\Requests\UpdateProductGroupRequest;
use App\Events\SuggestionRejected;
use App\Events\SuggestionAccepted;

class ProductGroupController extends Controller
{
  public function index($letter = 'A'){
    if (\Auth::check()) {
      $products = ProductGroup::where('name', 'LIKE', $letter.'%');

      if ($letter == "D"){
        $products = $products->where('name', 'NOT LIKE', "Dž".'%')->orderBy('name', 'ASC');
      } elseif($letter == 'L') {
        $products = $products->where('name', 'NOT LIKE', "Lj".'%')->orderBy('name', 'ASC');
      } else {
        $products = $products->orderBy('name', 'ASC');
      }
      $products = $products->paginate(20);

      return view('admin.listed.products', compact('products', 'letter'));
    }else{

      $productGroups = ProductGroup::select('id', 'name')->orderBy('name', 'asc')->get();
      if(isset($_GET['sortiranje'])){
        switch ($_GET['sortiranje']) {
          case 'proizvodi_asc':
            $productGroups = $productGroups->sortBy(function($productGroup){
              return $productGroup->products->count();
            }, SORT_REGULAR, false);
          break;
          case 'proizvodi_desc':
              $productGroups = $productGroups->sortBy(function($productGroup){
                return $productGroup->products->count();
              }, SORT_REGULAR, true);
          break;
          case 'ime_desc':
            $productGroups = $productGroups->sortByDesc('name');
          break;

          default:
            $productGroups = $productGroups;
          }
          }

      return view('guest.pages.productGroups', compact('productGroups'));
    }


  }


  public function view(ProductGroup $productGroup){
    $product = $productGroup;
    $productGroupsProducts = $product->products()->orderBy('name', 'asc')->with('manufacturer', 'category')->get();
    //da bih zapamtio iz koje je pretrage:
    if(isset($_GET['term'])) session(['term'=> $_GET['term']]) ;
    if(isset($_GET['manuf'])) session(['manuf'=> $_GET['manuf']]) ;
    $tags=$product->tags()->inRandomOrder()->get();
    // dd(session()->all());
    return view('guest.check.productGroup', compact('product', 'tags', 'productGroupsProducts'));
  }



  public function store(StoreProductGroupRequest $request){
    $validated = $request->validated();
    // dd(request()->all());

    if(request('isFromSuggestion') && !intval(request('suggestionAccepted'))){
      event(new SuggestionRejected(request('suggestionId')));
      return redirect()->route('home')->withSuccess('Sugestija je uspješno obrađena : proizvod nije prihvaćen');
    }

     if ($product = ProductGroup::store($request)){
       //ako se kreirao iz sugestije korisnika
       if(request('isFromSuggestion') && intval(request('suggestionAccepted'))){
       event(new SuggestionAccepted($product, $request));
       }
       $msg = !request('isFromSuggestion')? 'Proizvod je uspješno ubačen' : 'Sugestija je uspješno obrađena : proizvod prihvaćen';
       return redirect()->route('productGroups', $product->name[0])->withSuccess($msg);
     }
  }

  public function edit($id){
    $product = ProductGroup::withTrashed()->find($id);
    $tags = "";
    foreach ($product->tags as $key=>$tag) {
      if ($key !== count($product->tags)-1){
        $tags .= $tag->name. ",";
      } else {
         $tags .= $tag->name;
      }
    }
    return view('admin.createOrEdit', compact('product', 'tags'));
  }

  public function update(UpdateProductGroupRequest $request, ProductGroup $product)
  {
      $validated = $request->validated();
      if (ProductGroup::updateProduct($product, $request)) return redirect()->route('home')->withSuccess('Proizvod'.$product->name.'je uspješno izmjenjen');
  }

  public function destroy($id){
    ProductGroup::destroy($id);
    return redirect()->route('products')->withSuccess('Proizvod je uspješno obrisan.');
  }

  public function indexTrash($letter = 'a'){
    $products = ProductGroup::onlyTrashed()->where('name', 'LIKE', $letter.'%');
    if (request('sort')) $products = $products->orderBy(request('sort'), 'ASC');
    if ($letter == "D"){
      $products = $products->where('name', 'NOT LIKE', "Dž".'%')->orderBy('name', 'ASC');
    } elseif($letter == 'L') {
      $products = $products->where('name', 'NOT LIKE', "Lj".'%')->orderBy('name', 'ASC');
    } else {
      $products = $products->orderBy('name', 'ASC');
    }
    $products = $products->paginate(20);
    return view('admin.listed.products', compact('products', 'letter'));
  }



  public function restore($id){
    $product = ProductGroup::onlyTrashed()->where('id', $id)->restore();
    return redirect()->route('trashedProducts')->withSuccess('Proizvod je uspješno vraćen');
  }
}
