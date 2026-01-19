<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;
    
    protected $table = 'products';
    
    protected $fillable = ['name'];
    
    public function categories(){
        return $this->belongsTo(Category::class, 'pro_cat');
    }
    
    public function orders()
    {
        return $this->belongsToMany(orders::class, 'orders_products', 'products_id', 'orders_id')
                    ->withPivot('qty', 'total', 'tax');
    }
    
    // Relationship for Product model (table: product)
    public function productOrders()
    {
        return $this->belongsToMany(orders::class, 'orders_products', 'products_id', 'orders_id')
                    ->withPivot('qty', 'total', 'tax');
    }
}
