<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        // $post = Post::paginate(4);
        // $category = Category::all();
        Paginator::useBootstrap();
        // View::share('all_category', $category);
        // View::share('all_post', $post);
    }
}
