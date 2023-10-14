<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

use App\Models\Category;
use App\Models\Region;

class Service extends Model implements HasMedia
{
    use HasFactory, HasUlids, InteractsWithMedia;

    protected $fillable = [
        'title', 
        'url', 
        'youtube_url', 
        'category_id', 
        'region_id', 
        'content', 
        'price', 
        'type', 
        'likes', 
        'rating', 
        'published', 
    ];

    public function uniqueIds()
    {
        return [ 'original_id', ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'service_id');
    }
}
