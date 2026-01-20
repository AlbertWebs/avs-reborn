<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $table = 'product';
    
    protected $fillable = [
        'name',
        'slung',
        'code',
        'content',
        'meta',
        'iframe',
        'price',
        'price_raw',
        'brand',
        'cat',
        'sub_cat',
        'thumbnail',
        'image_one',
        'image_two',
        'image_three',
        'fb_pixels',
        'google_product_category',
        'offer',
        'offer_banner',
        'stock',
        'replaced',
        'tag',
        'featured',
        'slider',
        'trending',
        'full',
        'banner'
    ];
    
    public function orders()
    {
        return $this->belongsToMany(orders::class, 'orders_products', 'products_id', 'orders_id')
                    ->withPivot('qty', 'total', 'tax');
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'cat');
    }
}