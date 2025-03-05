<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'otp', 'role'];

    protected $hidden = ['otp'];

    public function profile(): HasOne
    {
        return $this->hasOne(CustomerProfile::class);
    }

    public function productReview(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }
}
