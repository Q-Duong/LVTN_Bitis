<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\CategoryPost;
use App\Models\Banner;

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
            $getAllBanner=Banner::get();

            $view->with(compact('getAllListCategory','getAllListCategoryType','getAllListCategoryPost','getAllBanner'));
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
