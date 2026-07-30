<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'type',
        'image',
        'description',
        'meta_title',
        'meta_description',
        'status',
        'video',
        'admin_id',
        'view',
        'like',
        'share',
        ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function sub_categories()
    {
        return $this->belongsToMany(Subcategory::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function post_like()
    {
        return $this->hasMany(PostLike::class,'post_id','id');
    }

    public function post_favourite()
    {
        return $this->hasMany(AddToFavourite::class,'post_id','id');
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class)->where('status',1);
    }

    public function scopeStatus($query)
    {
        return $query->where('status', 'publish');
    }
}
