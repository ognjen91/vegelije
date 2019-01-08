<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AdminProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
      view()->composer(['admin.*',
                        'includes.header',
                        'includes.adminHeader'], function($view){
          $view->with('user', \Auth::user());
      });

      view()->composer(['admin.createOrEdit', 'admin.suggestionReview'], function($view){
        $view->with('categories', \App\Category::all())
             ->with('manufacturers',  \App\Manufacturer::orderBy('name', 'asc')->get())
             ->with('productGroups',  \App\ProductGroup::select('id', 'name')->get());
      });


      \Blade::if('productsPage', function(){
        return \Route::currentRouteName() == "products" || \Route::currentRouteName() == 'trashedProducts' || \Route::currentRouteName() == 'manufacturerProducts';
      });

      \Blade::if('errors', function(){
        if(session('errors')) return true;
        return false;
      });

      \Blade::if('create', function(){
        $isOnCreatePage = \Route::currentRouteName() == 'newProduct'; //jer edit rute u imenu sadrze 'edit'
        if ($isOnCreatePage) return true;
        return false;
      });

      \Blade::if('edit', function(){
        $isOnEditPage = strpos(\Route::currentRouteName(), 'edit') !== false; //jer edit rute u imenu sadrze 'edit'
        if ($isOnEditPage) return true;
        return false;
      });

      \Blade::if('trashed', function(){
        $isOnEditPage = strpos(\Route::currentRouteName(), 'trash') !== false; //jer trash rute u imenu sadrze 'edit'
        if ($isOnEditPage) return true;
        return false;
      });

      \Blade::if('admin', function(){
        if (\Auth::user()->hasRole('admin')) return true;
        return false;
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
