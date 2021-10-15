<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;

    protected $fillable = [
        'author_id', 'title', 'slug', 'content', 'status'
    ];

    protected $withCount = [
        'images',
        'comments'
    ];

    protected $appends = [
        'count_comments'
    ];

    /*public function setTitleAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }*/

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)
            ->whereNull('parent_id');
    }

    public function getCountCommentsAttribute()
    {
        return Comment::query()->where('post_id', $this->id)->count();
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getMainImageAttribute()
    {
        return $this->images()->first();
    }
}
