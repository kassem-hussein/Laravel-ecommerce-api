<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table ="orders_details";
    protected $guarded = [];


    public function product():BelongsTo{
        return $this->belongsTo(Product::class,"product","id");
    }
    public function size():BelongsTo{
        return $this->belongsTo(Size::class,"size","id");
    }
    public function color():BelongsTo{
        return $this->belongsTo(Color::class,"color","id");
    }


}
