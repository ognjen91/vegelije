<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Notifications\ProductGroupEditSuggestionCreated;


class ProductGroupEditSuggestion extends Model
{

  protected $guarded = ['id'];

  public function productGroup()
  {
    return $this->belongsTo(ProductGroup::class);
  }


  protected static function boot(){
    parent::boot();
    //ovdje je model upravo nova sugestija
    static::created(function($model){
      foreach (\App\User::all() as $user) {
        if ($user->hasAnyRole(['Admin', 'Moderator']))

        $user->notify(new ProductGroupEditSuggestionCreated($model->id, $model->productGroup->name));
      }
    });
  }



  public static function store($request, $productGroup){
    $suggestion = new self;
    $suggestion->suggestion = $request->suggestion;
    $suggestion->product_group_id = $productGroup->id;
    if($request->shouldSaveSuggester){
      $suggestion->suggestedBy = $request->suggestedBy;
      $suggestion->proposerEmail = $request->proposerEmail;
    }
     if ($suggestion->save()) return true;
     return false;
  }
}
