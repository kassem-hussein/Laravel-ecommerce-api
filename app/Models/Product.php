<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;
    protected $table ="products";
    protected $guarded = [];

    public function category():HasOne{
        return $this->hasOne(Category::class,"product","id");
    }
    public function brand():HasOne{
        return $this->hasOne(Brand::class,"product","id");
    }
    public function images():HasMany{
        return $this->hasMany(ProductImage::class,"product","id");
    }
    public function colors():HasMany{
        return $this->hasMany(Color::class,"product","id");
    }
    public function sizes():HasMany{
        return $this->hasMany(Size::class,"product","id");
    }
}
