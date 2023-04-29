<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('frontend.template.sidebar', function($view){
            DB::statement("SET SQL_MODE=''");

            $posts = DB::table('posts')
                        ->select(
                            'slug',
                            'title',
                            DB::raw('count(view_posts.post_id) as view')
                        )
                        ->join('view_posts', 'posts.id', '=', 'view_posts.post_id')
                        ->groupBy('posts.id')
                        ->orderBy('view','desc')
                        ->limit(5)
                        ->get();

            $view->with('popular_posts', $posts);
        });
    }
}
