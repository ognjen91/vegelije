<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ImageWizzard;
use App\Http\Requests\StoreProductGroupRequest;
use App\Http\Requests\UpdateProductGroupRequest;

class ProductGroup extends Model
{
    use SoftDeletes;
    use ImageWizzard;

    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

  public function products()
    {
        return $this->belongsToMany(Product::class); //preko pivot-a product_product_group
    }

    public function user(){
      return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function alternativeNames()
  {
      return $this->morphMany(AlternativeName::class, 'nameable');
  }

  public function suggestion(){
    return $this->belongsTo(Suggestion::class, 'fromSuggestion')->withTrashed();;
  }

  public function tags()
   {
       return $this->morphToMany(Tag::class, 'taggable');
   }

   public function productGroupEditSuggestions()
   {
       return $this->hasMany(ProductGroupEditSuggestion::class);
   }

   public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

   public static function store(StoreProductGroupRequest $request){
      $product = new self;
      $product->name = request('name');
      $product->category_id = request('category_id');
      $product->description = request('description');
      $product->user_id = \Auth::user()->id;
      if (request('suggestedBy') !== null) $product->suggestedBy = request('suggestedBy');


      if (!$product->save()) {
          return false;
      }


      //snimam sliku i dodjeljujem je za profilnu modelu
      $image = self::storeImage($request, 'image', $product);
      if ($image) {
          $product->image =  $image;
          $product->save();
      }

      // tagovi, posto su prosli valdiaciju, postoje, kao i legality
      // ali dolaze u formatu  tag1,tag2,tag3,tag4... pa cu sada to ispraviti:
      $tags = explode(",", request('tags'));
      Tag::attachMultipleToModel($tags, $product);

      return $product;

   }

   public static function updateProduct($product, UpdateProductGroupRequest $request)
   {
     $product->name = request('name');
     $product->category_id = request('category_id');
     $product->description = request('description');


       $image = self::updateImage($request, 'image', $product->image); //ako ima nove slike, brise staru,, ubacuje novu i vraca ime; ako nema, vraca false
       if ($image) {
           $product->image =  $image;
       }

       if ($product->save()) {
           $tags = explode(",", request('tags'));
           Tag::attachMultipleToModel($tags, $product);
           // Legality::syncLegality(intval(request('legality')), $product);
       };

       return true;
   }

}
