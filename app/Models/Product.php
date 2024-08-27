<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['code',
     'name',
      'slug',
       'image',
        'price',
        'sale_price',
        'description',
        'material',
        'soft_delete',
        'category_id',
        'brand_id',

    ];
    public function category() :BelongsTo{
        return $this->belongsTo(Category::class);
    }
    public function brand() :BelongsTo{
        return $this->belongsTo(Brand::class);
    
    }
    public function variants(){
        return $this->hasMany(ProductVariant::class);
    }
    public function color(){
        return $this->belongsTo(Color::class);
    }
    public function size(){
        return $this->belongsTo(Size::class);
    }   
}
