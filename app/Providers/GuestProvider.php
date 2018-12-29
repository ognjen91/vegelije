<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Manufacturer;

class GuestProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
      view()->composer('welcome', function($view){
          $view->with('lastTags', \App\Tag::orderBy('created_at', 'desc')->get()->take(10))
               ->with('randomTags', \App\Tag::get()->random(25));


      });

      view()->composer('includes.footer', function($view){
          $view->with('categories', \App\Category::select('id', 'name')->get());
      });

      view()->composer(['welcome', 'guest.pages.manufacturers'], function($view){
          $view->with('manufacturers', \App\Manufacturer::orderBy('name', 'asc')->select('id', 'name')->with('products')->get());
      });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
