<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
        'slug',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
            $slugCount = static::where('slug', $category->slug)->count();
            if ($slugCount > 0) {
                $category->slug .= '-' . ($slugCount + 1);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('name')) {
                $category->slug = Str::slug($category->name);
                $slugCount = static::where('slug', $category->slug)->where('id', '!=', $category->id)->count();
                if ($slugCount > 0) {
                    $category->slug .= '-' . ($slugCount + 1);
                }
            }
        });
    }
}