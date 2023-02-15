<?php
 
namespace App\View\Composers;
 
use App\Models\Post;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
 
class PostComposer{
    
    protected $post;
 
    public function __construct(Post $post){
        $this->post = $post;
    }
 
    public function compose(){

        if($this->post->blocked_at != null){
            
            View::composer([
                    'backend.post.show', 
                    'backend.controlpost.banned_post'
                ], 
                function ($view) {
                    $block = DB::table('banned_posts')
                        ->select('reason','added_at')
                        ->where('post_id', $this->post->id)
                        ->first();

                    $view->with('block', $block);
                });

        }
    }
}