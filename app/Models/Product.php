<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'short_des',
        'price',
        'discount',
        'discount_price',
        'image',
        'stock',
        'star',
        'remark',
        'category_id',
        'brand_id',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function productCart(): HasMany
    {
        return $this->hasMany(ProductCart::class);
    }

    public function productDetail(): HasMany
    {
        return $this->hasMany(ProductDetail::class);
    }

    public function productReview(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }

    public function productWishlist(): HasMany
    {
        return $this->hasMany(ProductWish::class);
    }

    public function invoiceProduct(): HasMany
    {
        return $this->hasMany(InvoiceProduct::class);
    }
}
