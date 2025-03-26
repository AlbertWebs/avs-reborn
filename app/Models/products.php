<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    protected $table = 'products';
    
    public function categories(){
        
        return $this->belongsTo('Categories','pro_cat');
    }
}
