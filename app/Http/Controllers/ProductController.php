<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Events\SuggestionRejected;
use App\Events\SuggestionAccepted;
use App\MainAd;
use App\Counter;

class ProductController extends Controller
{


    public function __construct()
  {
          // $this->middleware('auth', ['only' => ['store', 'edit', 'update', 'destroy', 'indexTrash', 'restore']]);
  }

   public function index($letter = 'A'){
     $products = Product::where('name', 'LIKE', $letter.'%');
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




   public function store(StoreProductRequest $request){
     // dd($request->all());

     $validated = $request->validated();
      //ako se obradjuje sugestija i odbijena je
     if(request('isFromSuggestion') && !intval(request('suggestionAccepted'))){
           event(new SuggestionRejected(request('suggestionId')));
           return redirect()->route('home')->withSuccess('Sugestija je uspješno obrađena : proizvod nije prihvaćen');
     }
    if ($product = Product::store($request)){
            //ako se kreirao iz sugestije korisnika
            if(request('isFromSuggestion') && intval(request('suggestionAccepted'))){
            event(new SuggestionAccepted($product, $request));
            }
            $msg = !request('isFromSuggestion')? 'Proizvod je uspješno ubačen.': 'Sugestija je uspješno obrađena : proizvod prihvaćen';
            return redirect()->route('editProduct', $product->id)->withSuccess($msg);
      }
   }

   public function view(Product $product){
     $product->viewsCount += 1;
     $product->save();

     Counter::incrementProductsViews();

     $similarProducts = $product->itemsWithCommonTags();

     $recommendedProductsCounter = Product::where('isRecommended', '1')->get()->count();
     if($recommendedProductsCounter){
       $products  = Product::where('isRecommended', '1')->inRandomOrder();
       $recommendedProducts = $recommendedProductsCounter >= 4? $products->take(4)->get() : $products->take($recommendedProductsCounter)->get();
     } else {
       $recommendedProducts = collect([]);
     }

     //da bih zapamtio iz koje je pretrage:
     if(isset($_GET['term'])) session(['term'=> $_GET['term']]) ;
     if(isset($_GET['manuf'])) session(['manuf'=> $_GET['manuf']]) ;
     $tags=$product->tags()->inRandomOrder()->get();


     // $productsWithCommonTags = $product->itemsWithCommonTags();
     return view('guest.check.product', compact('product', 'tags', 'similarProducts', 'recommendedProducts'));
   }


   public function edit($id){
     $product = Product::withTrashed()->find($id);
     $tags = "";
     $productProductGroups = $product->productGroups()->pluck('id')->toArray();
     $productEditSuggestions = $product->productEditSuggestions()->paginate(10);

     foreach ($product->tags as $key=>$tag) {
       if ($key !== count($product->tags)-1){
         $tags .= $tag->name. ",";
       } else {
          $tags .= $tag->name;
       }
     }

     return view('admin.createOrEdit', compact('product', 'tags', 'productProductGroups', 'productEditSuggestions'));
   }



   public function update(UpdateProductRequest $request, Product $product)
   {
       $validated = $request->validated();
       if (Product::updateProduct($product, $request)) return redirect()->route('editProduct', $product->id)->withSuccess('Proizvod '.$product->name.' je uspješno izmjenjen');
   }


   public function destroy($id){
     Product::destroy($id);
     return redirect()->route('products')->withSuccess('Proizvod je uspješno obrisan.');
   }

   public function indexTrash($letter = 'a'){
     $products = Product::onlyTrashed()->where('name', 'LIKE', $letter.'%');
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
     $product = Product::onlyTrashed()->where('id', $id)->restore();
     return redirect()->route('trashedProducts')->withSuccess('Proizvod je uspješno vraćen');
   }

}
