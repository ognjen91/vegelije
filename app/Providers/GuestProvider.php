<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\SecondAd;
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
          $view->with('randomTags', \App\Tag::getLatest());


      });

      view()->composer('includes.footer', function($view){
          $view->with('categories', \App\Category::select('id', 'name')->get());
      });

      view()->composer(['welcome', 'guest.pages.manufacturers'], function($view){
          $view->with('manufacturers', \App\Manufacturer::orderBy('name', 'asc')->select('id', 'name', 'image')->with('products')->get());
      });

      view()->composer(['welcome','guest.*'], function($view){
          $view->with('mainAds', \App\MainAd::getActives())
                ->with('secondAd', \App\SecondAd::where('active',1)->first());
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
