<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Special extends Model
{
    use HasFactory;
    
    protected $table = 'special_offers';
    
    protected $fillable = [
        'product_id',
        'percent',
        'content'
    ];
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
