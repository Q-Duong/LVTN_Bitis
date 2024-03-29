<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\CategoryPost;
use App\Models\Discount;

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
            $getAllListDiscount=Discount::where('discount_id','<>',1)->orderBy('discount_id','ASC')->get();
            $getAllListCategoryPost=CategoryPost::orderBy('category_post_id','ASC')->get();
           
            $view->with(compact('getAllListCategory','getAllListCategoryType','getAllListDiscount','getAllListCategoryPost'));
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
