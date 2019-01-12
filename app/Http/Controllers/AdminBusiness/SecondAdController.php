<?php

namespace App\Http\Controllers;
use App\SecondAd;

use Illuminate\Http\Request;

class SecondAdController extends Controller
{

    public function create(){
      if(!\Auth::user()->hasAnyRole('Admin')) return redirect()->back()->withError('no-no');
      return view('admin.business.ads.createSecond');
    }

    public function store(Request $request){
      $rules = [
            'name'=>'required|min:2',

            'sideImage'=> 'max:4000|mimes:jpg,jpeg,png',
            'downImage'=> 'max:4000|mimes:jpg,jpeg,png'
        ];

      $messages = [
            'name.required' => 'Naziv reklame je neophodno uneti',
            'name.required' => 'Molimo unesite trajanje popup-a!',
            'sideImage.uploaded' => 'Max veličina sidebar slike je 3,5MB',
            'sideImage.mimes' => 'Neodgovarajući format slike za sidebar. Dozvoljeni formati su: jpg, jpeg, png',
            'downImage.uploaded' => 'Max veličina donje slike je 3,5MB',
            'downImage.mimes' => 'Neodgovarajući format slike. Dozvoljeni formati su: jpg, jpeg, png'
      ];

        $this->validate($request, $rules, $messages);

      if(SecondAd::store($request)){
        return redirect()->route('ads')->withSuccess('Reklama ubacena');
      };

    }

    public function edit(SecondAd $secondAd){

      return view('admin.business.ads.editSecond', compact('secondAd'));

    }

    public function update(Request $request, SecondAd $secondAd){
      if( SecondAd::updateAd($secondAd, $request)){
        return redirect()->route('ads')->withSuccess('Reklama promjenjena');
      };
    }

    public function setActive(Request $request){
      $ads = SecondAd::all();
      foreach ($ads as $ad) {
        $ad->active = $ad->id == $request->active? 1 : 0;
        $ad->save();
      }
      return redirect()->back()->withSuccess('Aktivna sporedna reklama je uspješno postavljena');
    }

    public function destroy(SecondAd $secondAd){
      //posto su povezane sa fotografijama, moram rucno...
      if(SecondAd::destroyIt($secondAd)) return redirect()->route('ads')->withSuccess('Reklama izbrisana');
    }

}
