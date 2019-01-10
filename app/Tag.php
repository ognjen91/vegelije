<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Tag extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function getRouteKeyName(){
    return 'name';
    }

    public function products()
    {
        return $this->morphedByMany('App\Product', 'taggable');
    }

    public function productGroups()
    {
        return $this->morphedByMany('App\ProductGroup', 'taggable');
    }


    public static function attachMultipleToModel(array $arrayOfTagNames, Model $model)
    {
        $tags = [];
        foreach ($arrayOfTagNames as $tagName) {
            $newTag = static::firstOrCreate(['name' => $tagName]);
            $tags[] = $newTag->id; //
        }
        if ($model->tags()->sync($tags)) return true;
    }






}
