<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

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

    public function scopeActive(Builder $query): void
    {
        $query->where('is_publish', true);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function view_posts(): HasMany
    {
        return $this->hasMany(ViewPost::class,'post_id');
    }
}
