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

       $image = self::storeImage($request, 'image'); //RAZMOTRI DIREKTORIJ!!!
       if ($image) {
           $suggestion->image =  $image;
       }

       $declarationImage = self::storeImage($request, 'declarationImage'); //RAZMOTRI DIREKTORIJ!!!
       if ($declarationImage) {
           $suggestion->declarationImage =  $declarationImage;
       }

       if (!$suggestion->save()) {
           return false;
       }
       // tagovi, posto su prosli valdiaciju, postoje, kao i legality
       // ali dolaze u formatu  tag1,tag2,tag3,tag4... pa cu sada to ispraviti

       return true;

    }
}
