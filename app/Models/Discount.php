<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'product_id',
        'category_id',
        'percent_off',
        'fixed_off',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function isActive(): bool
    {
        $now = now();
        return (!$this->start_date || $now >= $this->start_date) &&
               (!$this->end_date || $now <= $this->end_date);
    }

    public function applyTo(float $price): float
    {
        if (!$this->isActive()) {
            return $price;
        }
        if ($this->percent_off) {
            return $price * (1 - ($this->percent_off / 100));
        } elseif ($this->fixed_off) {
            return max(0, $price - $this->fixed_off);
        }
        return $price;
    }
}