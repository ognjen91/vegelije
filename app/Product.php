<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ImageWizzard;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class Product extends Model
{
    use SoftDeletes;
    use ImageWizzard;

    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];


    public function productGroups()
    {
        return $this->belongsToMany(ProductGroup::class);  //preko pivot-a product_product_group
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

  public function user(){
    return $this->belongsTo(User::class);
  }

  public function manufacturer(){
    return $this->belongsTo(Manufacturer::class);
    // factory(App\Product::class, 300)->create()->each(function($u){$u->legalities()->sync([1,2]);});

  }


  public function tags()
   {
       return $this->morphToMany(Tag::class, 'taggable');
   }

   public function legalities(){
     return $this->morphToMany(Legality::class, 'legalable');
   }


  public static function store(StoreProductRequest $request){
     $product = new self;
     $product->name = request('name');
     $product->category_id = request('category_id');
     $product->description = request('description');
     $product->manufacturer_id = request('manufacturer_id');
     $product->user_id = \Auth::user()->id;

     // if()
     $image = self::storeImage($request, 'image');
     // dd($image);
     if ($image) {
         $product->image =  $image;
     }

     $declarationImage = self::storeImage($request, 'declarationImage');
     if ($declarationImage) {
         $product->declarationImage =  $declarationImage;
     }

     if (!$product->save()) {
         return false;
     }

     //u requestu dolazi i array productGroups, u kom su idevi odabranih grupa kojim pripada proizvod
     $product->productGroups()->sync(request('productGroups'));
     // tagovi, posto su prosli valdiaciju, postoje, kao i legality
     // ali dolaze u formatu  tag1,tag2,tag3,tag4... pa cu sada to ispraviti:
     $tags = explode(",", request('tags'));
     Tag::attachMultipleToModel($tags, $product);
     Legality::syncLegality(intval(request('legality')), $product);


     return $product; //trebace za event

  }

  public static function updateProduct($product, UpdateProductRequest $request)
  {
    $product->name = request('name');
    $product->category_id = request('category_id');
    $product->description = request('description');
    $product->manufacturer_id = request('manufacturer_id');


      $image = self::updateImage($request, 'image', $product->image); //ako ima nove slike, brise staru,, ubacuje novu i vraca ime; ako nema, vraca false
      if ($image) {
          $product->image =  $image;
      }

      $declarationImage = self::updateImage($request, 'declarationImage', $product->declarationImage); //ako ima nove slike, brise staru,, ubacuje novu i vraca ime; ako nema, vraca false
      if ($declarationImage) {
          $product->declarationImage = $declarationImage;
      }

      if ($product->save()) {
          $product->productGroups()->sync(request('productGroups'));
          $tags = explode(",", request('tags'));
          Tag::attachMultipleToModel($tags, $product);
          Legality::syncLegality(intval(request('legality')), $product);
      };

      return true;
  }


}
