<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory, Sluggable;
    
    protected $guarded = ['id'];
    
    public function getRouteKeyName(){
        return 'slug';
    }

    public function sluggable(): array{
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    protected function PublishedAt(): Attribute{
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d-m-Y'),
            set: fn ($value) => Carbon::parse($value)->format('Y-m-d'),
        );
    }
    protected function BlockedAt(): Attribute{
        return Attribute::make(
            get: fn ($value) => is_null($value) ? null:Carbon::parse($value)->format('d-m-Y H:i:s'),
        );
    }
    public function category(){
    	return $this->belongsTo(Category::class);
    }
    public function user(){
    	return $this->belongsTo(User::class);
    }
    public function view_posts(){
        return $this->hasMany(ViewPost::class,'post_id');
    }
}
