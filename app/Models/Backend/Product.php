<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'slug',
        'brand_id',
        'category_id',
        'price',
        'status'
    ];

    public function images(){
        return $this->hasMany(ProductImage::class);
    }

    public function category(){
        return $this->belongsTo(Category::class); 
    }

    public function brand(){
        return $this->belongsTo(Brand::class); 
    }

}
