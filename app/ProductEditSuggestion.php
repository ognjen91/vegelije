<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Notifications\ProductEditSuggestionCreated;


class ProductEditSuggestion extends Model
{

  protected $guarded = ['id'];

  protected static function boot(){
    parent::boot();
    //ovdje je model upravo nova sugestija
    static::created(function($model){
      foreach (\App\User::all() as $user) {
        if ($user->hasAnyRole(['Admin', 'Moderator']))
        $user->notify(new ProductEditSuggestionCreated($model->id, $model->product->name, $model->product->manufacturer->name));
      }
    });
  }

  public function product()
  {
    return $this->belongsTo(Product::class);
  }


  public static function store($request, $product){
    $suggestion = new self;
    $suggestion->suggestion = $request->suggestion;
    $suggestion->product_id = $product->id;
    if($request->shouldSaveSuggester){
      $suggestion->suggestedBy = $request->suggestedBy;
      $suggestion->proposerEmail = $request->proposerEmail;
    }
     if ($suggestion->save()) return true;
     return false;
  }
}
