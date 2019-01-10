<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MainAd;
use App\Image;



class MainAdController extends Controller
{


  public function create(){
    if(!\Auth::user()->hasAnyRole('Admin')) return redirect()->back()->withError('no-no');
    return view('admin.business.ads.createMain');
  }

  public function store(Request $request){

    $rules = [
          'name'=>'required|min:2',
          'intervalInSeconds'=>'required|integer',
          'popupImage'=> 'max:4000|mimes:jpg,jpeg,png',
          'downImage'=> 'max:4000|mimes:jpg,jpeg,png'
      ];

    $messages = [
          'name.required' => 'Naziv reklame je neophodno uneti',
          'name.required' => 'Molimo unesite trajanje popup-a!',
          'popupImage.uploaded' => 'Max veličina popup slike je 3,5MB',
          'popupImage.mimes' => 'Neodgovarajući format slike. Dozvoljeni formati su: jpg, jpeg, png',
          'downImage.uploaded' => 'Max veličina donje slike je 3,5MB',
          'downImage.mimes' => 'Neodgovarajući format slike. Dozvoljeni formati su: jpg, jpeg, png'
    ];

      $this->validate($request, $rules, $messages);

    if( MainAd::store($request)){
      return redirect()->route('ads')->withSuccess('Reklama ubacena');
    };

  }

  public function edit(MainAd $mainAd){

    return view('admin.business.ads.editMain', compact('mainAd'));

  }

  public function update(Request $request, MainAd $mainAd){
    if( MainAd::updateAd($mainAd, $request)){
      return redirect()->route('ads')->withSuccess('Reklama promjenjena');
    };
  }

  public function setActive(Request $request){
    $ads = MainAd::all();
    foreach ($ads as $ad) {
      $ad->active =  in_array($ad->id, $request->active)? 1 : 0;
      $ad->save();
    }

    return redirect()->back()->withSuccess('Aktivna glavna reklama je uspješno postavljena');
  }

  public function destroy(MainAd $mainAd){
    //posto su povezane sa fotografijama, moram rucno...
    if(MainAd::destroyIt($mainAd)) return redirect()->route('ads')->withSuccess('Reklama izbrisana');
  }

}
