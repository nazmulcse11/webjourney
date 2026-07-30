<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'price',
        'type',
        'image',
        'description',
        'meta_title',
        'meta_description',
        'status',
        'video',
        'admin_id',
        'view',
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
}
