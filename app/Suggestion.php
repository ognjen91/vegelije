<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ImageWizzard;
use App\Http\Requests\SuggestProductRequest;
use App\Notifications\NewSuggestionCreated;

class Suggestion extends Model
{
  use SoftDeletes;
  use ImageWizzard;
  protected $guarded = ['id'];
  protected $dates = ['deleted_at'];

  public function product(){
    return $this->hasOne(Product::class, 'fromSuggestion')->withTrashed();;
  }

  public function productGroup(){
    return $this->hasOne(ProductGroup::class, 'fromSuggestion')->withTrashed();;
  }

  public function images()
   {
       return $this->morphMany(Image::class, 'imageable');
   }

    protected static function boot(){
      parent::boot();
      //ovdje je model upravo nova sugestija
      static::created(function($model){
        foreach (\App\User::all() as $user) {
          if ($user->hasAnyRole(['Admin', 'Moderator'])) $user->notify(new NewSuggestionCreated($model->id, $model->name));
        }
      });
    }


    public static function store(SuggestProductRequest $request){
       $suggestion = new self;
       $suggestion->name = request('name');
       $suggestion->manufacturer = request('manufacturer');
       $suggestion->description = request('description');
       $suggestion->legality= request('legality');
       $suggestion->tags= request('tags');
       if (request('suggestedBy') !== null) $suggestion->suggestedBy = request('suggestedBy');



       if (!$suggestion->save()) {
           return false;
       }

       if($request->hasFile('images')){
         return self::storeMultipleImages($request, 'images', $suggestion);
       } else {
         return true;
       }

    }
}
