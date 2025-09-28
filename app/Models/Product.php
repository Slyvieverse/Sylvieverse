<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'stock_quantity',
        'image_url',
        'is_featured',
        'status',
        'user_id',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function auctions()
    {
        return $this->hasMany(Auction::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function watchlist()
    {
        return $this->hasMany(Watchlist::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }
    public function activeDiscount()
    {
        return $this->discounts()->where(function ($query) {
            $query->whereNull('start_date')->orWhere('start_date', '<=', now());
        })->where(function ($query) {
            $query->whereNull('end_date')->orWhere('end_date', '>=', now());
        })->first();
    }

    public function getDiscountedPrice(): float
    {
        $discount = $this->activeDiscount();
        return $discount ? $discount->applyTo($this->price) : $this->price;
    }
    public function user()
{
    return $this->belongsTo(User::class);
}

}