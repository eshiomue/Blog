<?php

namespace App\Providers;

use App\Models\BlogCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         Paginator::useBootstrap();
        View::composer('*', function ($view) {
            $blog_categories = BlogCategory::get()->take(5);
            $active_profile = Auth::user();
            $view->with(['blog_categories'=> $blog_categories, 'active_profile' => $active_profile]);
        });
    }
}
