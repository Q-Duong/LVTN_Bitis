<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\CategoryPost;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*',function($view) {
            
            $getAllListCategory=Category::orderBy('category_id','ASC')->get();
            $getAllListCategoryType=CategoryType::orderBy('category_type_id','ASC')->get();
            $getAllListCategoryPost=CategoryPost::orderBy('category_post_id','ASC')->get();
            $view->with(compact('getAllListCategory','getAllListCategoryType','getAllListCategoryPost'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
