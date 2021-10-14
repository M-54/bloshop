<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;

    protected $fillable = [
        'author_id', 'title', 'slug', 'content', 'status'
    ];

    /*public function setTitleAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }*/

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
