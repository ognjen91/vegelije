<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ImageWizzard;
use App\Http\Requests\SuggestProductRequest;
use App\Notifications\ImageSuggestionCreated;

class ImageSuggestion extends Model
{
  // use SoftDeletes;
  use ImageWizzard;
  protected $guarded = ['id'];
  // protected $dates = ['deleted_at'];



  public function images()
   {
       return $this->morphMany(Image::class, 'imageable');
   }

   public function product()
   {
     return $this->belongsTo(Product::class);
   }

    protected static function boot(){
      parent::boot();
      //ovdje je model upravo nova sugestija
      // static::created(function($model){
      //   foreach (\App\User::all() as $user) {
      //     if ($user->hasAnyRole(['Admin', 'Moderator'])) $user->notify(new ImageSuggestionCreated($model->id, $model->name));
      //   }
      // });
    }


    public static function store($request, $product){
       $imagesSuggestion = new self;
       $imagesSuggestion->product_id = $product->id;

       if (!$imagesSuggestion->save()) {
           return false;
       } else {
           self::storeMultipleImages($request, 'images', $imagesSuggestion);
           foreach (\App\User::all() as $user) {
             if ($user->hasAnyRole(['Admin', 'Moderator'])) $user->notify(new ImageSuggestionCreated($imagesSuggestion->id, $product->name, $product->manufacturer->name));
           }
           return true;
       }
    }


    
}
