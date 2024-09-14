<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory;

    //protected $guarded = ['id'];
    protected $fillable = ['title','slug','category_id','author_id','is_publish','image','excerpt','body'];

    public function getRouteKeyName(){
        return 'slug';
    }
    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function category(): HasOne
    {
        return $this->hasOne(Category::class);
    }
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
