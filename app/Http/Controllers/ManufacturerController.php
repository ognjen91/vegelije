<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Manufacturer;
use App\Product;
use App\Events\SuggestionRejected;
use App\Events\SuggestionAccepted;

class ManufacturerController extends Controller
{
  public function __construct()
{
        // $this->middleware('auth', ['except' => ['index', 'view']]);
}

   public function index($letter = 'A'){
     if (\Auth::check()) {
           $manufacturers = Manufacturer::where('name', 'LIKE', $letter.'%');
           if (request('sort')) $manufacturers = $manufacturers->orderBy(request('sort'), 'ASC');
              if ($letter == "D"){
                $manufacturers = $manufacturers->where('name', 'NOT LIKE', "Dž".'%')->orderBy('name', 'ASC');
              } elseif($letter == 'L') {
                $manufacturers = $manufacturers->where('name', 'NOT LIKE', "LJ".'%')->orderBy('name', 'ASC');
              } else {
                $manufacturers = $manufacturers->orderBy('name', 'ASC');
            }

           $manufacturers = $manufacturers->paginate(20);
           return view('admin.listed.manufacturers', compact('manufacturers', 'letter'));
   }else{
     return view('guest.pages.manufacturers');
   }

   }

   public function create(){
     return view('admin.createOrEditManufacturer');
   }


  //izlistavanje proizvoda proizvođača
   public function view(Manufacturer $manufacturer, $letter = "A"){

     if (\Auth::check()) {
       $products = $manufacturer->products()->where('name', 'LIKE', $letter.'%');

         if ($letter == "D"){
           $products = $products->where('name', 'NOT LIKE', "Dž".'%')->orderBy('name', 'ASC');
         } elseif($letter == 'L') {
           $products = $products->where('name', 'NOT LIKE', "Lj".'%')->orderBy('name', 'ASC');
         } else {
           $products = $products->orderBy('name', 'ASC');
         }
         $products = $products->paginate(10);
         return view('admin.listed.products', compact('manufacturer', 'products', 'letter'));

   } else {
     $products = $manufacturer->products()->orderBy('name', 'asc')->with('manufacturer', 'category')->get();
     return view('guest.listingProducts.byManufacturer', compact('manufacturer', 'products'));
   }

   }


   public function store(Request $request){

     $rules = [
           'name' => 'required|unique:manufacturers',
           'image'=> 'max:'. config('app.maxfilesize')*1024 . '|mimes:jpg,jpeg,png'
       ];

     $messages = [
           'name.required' => "Potrebno je da unesete naziv проizvođača.",
           'name.unique' => "Uneseni proizvođač već postoji.",
           'image.uploaded' => 'Slika je prevelika: dozvoljena veličina slike iznosi ' . config('app.maxfilesize') .'MB. Molimo, pokušajte ponovo',
           'image.mimes' => 'Neodgovarajući format slike. Dozvoljeni formati su: jpg, jpeg, png'
     ];

       $this->validate($request, $rules, $messages);

       $manufacturer = Manufacturer::store($request);
       return redirect()->route('manufacturers', $manufacturer->name[0])->withSuccess('Proizvođač '.$manufacturer->name. ' uspješno kreiran.');

   }



   public function edit($id){
     $manufacturer = Manufacturer::withTrashed()->find($id);

     return view('admin.createOrEditManufacturer', compact('manufacturer'));
   }



   public function update(Request $request, Manufacturer $manufacturer)
   {
     // dd($request->all());
     $rules = [
       'name' => 'required|unique:manufacturers,name,'. $request->manufacturer->id
     ];


     $messages = [
           'name.required' => "Potrebno je da unesete naziv проizvođača.",
           'name.unique' => "Uneseni proizvođač već postoji."
     ];

       $this->validate($request, $rules, $messages);
       if (Manufacturer::updateManufacturer($manufacturer, $request)) return redirect()->back()->withSuccess('Proizvođač'.$manufacturer->name.'je uspješno izmjenjen');

       }


   public function destroy($id){
     $manufacturer = Manufacturer::find($id);
     foreach ($manufacturer->products as $product) {
       Product::destroy($product->id);
     }


     Manufacturer::destroy($id);
     return redirect()->route('manufacturers')->withSuccess('Proizvođač je uspješno obrisan.');
   }

   public function indexTrash($letter = 'a'){
     $manufacturers = Manufacturer::onlyTrashed()->where('name', 'LIKE', $letter.'%');
     if (request('sort')) $manufacturers = $manufacturers->orderBy(request('sort'), 'ASC');
         if ($letter !== "D"){
           $manufacturers = $manufacturers->orderBy('name', 'ASC');
         } else {
           $manufacturers = $manufacturers->where('name', 'NOT LIKE', "Dž".'%')->orderBy('name', 'ASC');
        }
     $manufacturers = $manufacturers->paginate(20);
     return view('admin.listed.manufacturers', compact('manufacturers', 'letter'));
   }



   public function restore($id){
     Manufacturer::onlyTrashed()->where('id', $id)->restore();
     $manufacturer = Manufacturer::withTrashed()->find($id);
     $products =$manufacturer->products()->withTrashed()->get();
     foreach ($products as $product) {
       Product::onlyTrashed()->where('id', $product->id)->restore();
     }
     return redirect()->route('trashedManufacturers')->withSuccess('Proizvođač je uspješno vraćen');
   }

}
