<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ImageWizzard;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Image;
use App\ProductGroup;

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

    public function suggestion()
    {
        return $this->belongsTo(Suggestion::class, 'fromSuggestion')->withTrashed();

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function imageSuggestions()
    {
        return $this->hasMany(ImageSuggestion::class);
    }

    public function productEditSuggestions()
    {
        return $this->hasMany(ProductEditSuggestion::class);
    }


    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function legalities()
    {
        return $this->morphToMany(Legality::class, 'legalable');
    }


    public static function store(StoreProductRequest $request)
    {
        $product = new self;
        $product->name = request('name');
        $product->category_id = request('category_id');
        $product->description = request('description');
        $product->manufacturer_id = request('manufacturer_id');
        if (request('isRecommended')) {
            $product->isRecommended = request('isRecommended');
        }
        $product->user_id = \Auth::user()->id;
        if (request('suggestedBy') !== null) {
            $product->suggestedBy = request('suggestedBy');
        }


        if (!$product->save()) {
            return false;
        }


        //snimam sliku i dodjeljujem je za profilnu modelu
        $image = self::storeImage($request, 'image', $product);
        if ($image) {
            $product->image =  $image;
            $product->save();
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
        if (request('isRecommended') !== null) {
            $product->isRecommended = request('isRecommended');
        }
        $product->image = request('image') !== null? request('image') : "placeholder.png";


        if ($product->save()) {
            $product->productGroups()->sync(request('productGroups'));
            $tags = explode(",", request('tags'));
            Tag::attachMultipleToModel($tags, $product);
            Legality::syncLegality(intval(request('legality')), $product);
        };

        return true;
    }


 /**
  * PROIZVODI SA SLICNIM TAGOVIMA
  * @return [type] [description]
  */

    public function itemsWithCommonTags(){

      // dd($randomTags->pluck('id'));
      return Product::whereHas('tags', function ($query) {
          $noOfTags = $this->tags->count();
          $randomTags = $noOfTags > 5? $this->tags()->take(5)->get() : $this->tags()->take($noOfTags)->get();
              $tagIds = $randomTags->pluck('id');
              $query->whereIn('tags.id', $tagIds);
          })->where('id', '<>', $this->id)->where('category_id', $this->category_id)->get();
    }





    public static function withSimilarName($name){
      $products = self::select('id', 'name', 'manufacturer_id')->get();
      $groups = ProductGroup::select('id', 'name')->get();

      $similars = [];
      foreach ($products as $product) {
        $similarity = similar_text($name, $product->name, $perc);
        if($perc>50 || strpos($product->name, $name) !== false) $similars[] = $product;
      }
      foreach ($groups as $product) {
        $similarity = similar_text($name, $product->name, $perc);
        if($perc>50  ||  strpos($product->name, $name) !== false) $similars[] = $product;
      }
      return $similars;
    }


}
